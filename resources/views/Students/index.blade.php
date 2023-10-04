<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>M-Kadour</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<style>
body{
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;    display:flex;
    justify-content:center;
    align-items:center;
    direction: ltr;
    text-align: right;
}
svg{
    visibility:hidden;
}
table{
    width: 80%;
    border: 1px solid black;
    border-radius: 13px;
    border-collapse: collapse;
}
td ,th{
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
}
.tg{
    border-radius: 100%;
    width: 80px;
    height: 80px;
}
.nav{
    margin: 0;
    padding: 0;
    border-radius: 30px;
   
}
img{
    height: 100px;
    width: 110%;
    border-radius: 10px;
}
a, button{
    width: 100px;
    height: 55px;
    margin: 2.5px;
}
    /* Dark mode styles */
    body.dark-mode {
        background-color: #181818;
    }
    body.dark-mode table{
        border-color: #f8f9fa;
        color: #f5f5f5;
    }
    body.dark-mode input{
        border-color: #f8f9fa;
        background: #343a40;
    }
    body.dark-mode .nav{
        background-color: #343a40;
        color: #f8f9fa;
    }
   
    body.dark-mode p{
        color: white;
    }
   
    
    /* body.dark-mode img{
        filter: invert(100%);
    } */
    
</style>

<body>
    <div class="container mt-2">
        <div class="row nav">
        <img src="{{ asset('images/logo.jpeg') }}" alt="">
    </div>
    <div class="row">
            <button class="btn btn-secondary ml-auto tg" id="dark-mode-button">الوضع المظلم</button>
            <div class="col-lg-12 margin-tb">
                <a class="btn btn-success" href="{{ route('students.create') }}">تسجيل متعلم جديد</a>
                <div class="pull-left">
                </div>
                <div class="pull-right mb-2">
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <form action="{{ route('students.index') }}" method="get">
            <div class="form-group row">
                <label for="search" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8">
                    <input type="text" style="text-align: right;"  class="form-control" id="search" name="search" value="{{ old('search') }}" placeholder="أدخل رقم التسجيل أو إسم المتعلم ...">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary mb-2">إبحث عن المتعلم</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>رقم التسجيل</th>
                    <th>الإسم الكامل</th>
                    <th>القسم</th>
                    <th>تاريخ الإزدياد</th>
                    <th>مكان الإزدياد</th>
                    <th> ر ت</th>
                    <th>عمليات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->code }}</td>
                        <td>{{ $student->fullName }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->birthday }}</td>
                        <td>{{ $student->placeOfBirth }}</td>
                        <td>{{ $student->id }}</td>
                        <td>
                            <form action="{{ route('students.destroy',$student->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">تعديل المعطيات </a>
                                <a class="btn btn-success" href="{{ route('students.imprimer',$student->id) }}">طباعة</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حدف</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        <div class="links">
            {!! $students->links() !!}
        </div>
    </div>
    <script> 
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    };
        const darkModeButton = document.getElementById('dark-mode-button');
        darkModeButton.addEventListener('click', () => {
            toggleDarkMode();
            const buttonLabel = darkModeButton.innerHTML;
            darkModeButton.innerHTML = buttonLabel === 'الوضع المظلم' ? 'الوضع العادي' : 'الوضع المظلم';
        });
</script>

</body>
</html>
