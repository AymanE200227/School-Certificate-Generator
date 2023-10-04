<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $searchQuery = $request->query('search');
    if($searchQuery){
        $students =Student::where('code', 'LIKE', '%'.$searchQuery.'%')
                         ->orWhere('fullName',  'LIKE', '%'.$searchQuery.'%')        
                         ->orWhere('class', 'LIKE', '%'.$searchQuery.'%')
                         ->orWhere('birthday', 'LIKE', '%'.$searchQuery.'%')
                         ->orderBy('id','desc')
                         ->paginate(4);
    } else {
        $students = Student::orderBy('id', 'desc')->paginate(4);
    }
    return view('students.index' , compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'fullName' => 'required',
            'class' => 'required',
        ]);
        Student::create($request->post());
        return redirect()->route('students.create')->with('success','student has been added successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $students = Student::find($id);
        return view('students.show', compact(('students')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit' ,compact('students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $students)
    {
        $request->validate([
            'code'=>'required',
            'fullName'=>'required',
            'class'=>'required',
        ]);
        $students->fill($request->post())->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $students)
    {
        $students->delete();
        return redirect()->route('students.index')->with('success','student has been deleted !');
    }
    public function imprimer($id)
    {
        $Student = Student::find($id);
        $date = strftime(' %Y/ %m / %e ');
        $path = asset('images/logo.jpeg');
        $html = "<html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta http-equiv='content-type' content='text/html; charset=utf-8' />
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Document</title>
        </head>
        <body>
            
                <div class='container' >
                    <div class='c'>
                    <img src='$path'>
                    <div class='title'>
                        <h2>الأكاديمية الجهوية للتربية والتكوين لجهة بني ملال خنيفرة</h2>
                        <h2>المديرية الإقليمية بني ملال</h2>
                        <h2>جماعة بني ملال (البلدية)</h2>
                        <h2>ثانوية أحمد الحنصالي الإعدادية</h2>
                    </div>
                    <p>شهادة مدرسية رقم: $Student->certificateNum </p>
                    <table>
                        <tr>
                            <td>يشهد الموقع اسفله السيد: </td>
                            <th></th>
                        </tr>
                        <tr>
                            <td colspan='4' > بصفته مدير مؤسسة ثانوية أحمد الحنصالي الإعدادية</td>
                            <th></th>
                        </tr>
                        <tr>
                            <td colspan='4'>أن التلميذ (ة): $Student->fullName</td>
                            <th ></th>
                        </tr>
                        <tr>
                            <td colspan='2' >المولود(ة) في:&nbsp; &nbsp; $Student->placeOfBirth</td>
                            <th >بتاريخ: </th>
                            <th style='width:200px'> $Student->birthday</th>
                        </tr>
                        <tr>
                            <td>والمسجل(ة) تحت رقم:  $Student->code</td>
                            <th style='width: 100px; height: 40px;'>ممنوح</th>
                            <th style=' width: 100px; height: 40px;'>غير ممنوح</th>            </tr>
                        <tr>
                            <td  >كان يتابع دراسته (ا) بالقسم:</td>
                            <th colspan='2'> $Student->class</th>
                        </tr>
                        <tr>
                            <td  colspan='4'>وقد غادر(ت) المؤسسة بتاريخ: $Student->exitDate</td>
                            <th></th>
                        </tr>
                        <tr>
                            <td colspan='4'>ملاحظات:&nbsp; &nbsp;&nbsp; &nbsp; $Student->observation </td>
                            <th> </th>
                        </tr>
                    </table>
                    <div class='date'>حرر ببني ملال في: $date </div>
                    <div class='signature'><i>ختم المؤسسة    &nbsp; &nbsp;  الإمضاء </i></div>
                    <div class='note'>ملحوظة: هذه الشهادة لا تخول التسجيل في مؤسسة أخرى</div>
                </div>
            </div>
                <style>
                    .pp{
                       position: absolute;
                        margin: 100px -400px;
                        padding: 0;
                        width:1000px;
                        height:1400px;
                        font-style: italic;                                }
                    .container{
                        width: 1000px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        direction: rtl;
                    }
                    p ,.date{
                        font-size: 26px;    
                        font-weight: bold;
                        margin: 20px 0;
                        float: right;
                        
                    }
                    .date{
                        margin: 50px 0;

                    }
                    table{
                        width: 1000px;
                        float: right;

                    }
                    th,td{
                        padding: 15px 0px;
                        font-size: 32px;
                        font-weight: bold;
                    }
                    th{
                     text-align:center;
                    }
                    .signature{
                        float: left;
                        margin: 100px 0 0 50px;
                        font-size: 24px;
                    }
                    h2{
                        text-align: center;
                    }
                    td{
                        width: 500px;
                        text-align: right;

                        
                    }
                    img{
                        width: 1000px;
                    }
                    .note{
                       margin: 1050px 0 500px 0 ;
                       font-size: 24px;
                       text-align:center;
           
                   }
                    
                </style>
            
        </body>
</html>
            ";
            $Student->certificateNum += 1;
            $Student->save();
        return view('Students.imprimer', compact('Student','html'));
    }
}
