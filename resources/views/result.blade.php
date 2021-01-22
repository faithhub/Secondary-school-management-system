<html>    
  <head>
    <meta charset="utf-8">
    <title></title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </head>
  <body>
    <h1 style="text-align:center">EdChamp Education & Courses</h1> 
    <div class="row" style="margin-bottom:50px">
        <h3>Name: {{Auth::user()->surname}} {{Auth::user()->last_name}}</h3>
        <h3>Student ID: {{Auth::user()->email}}</h3>
        <h3>Class: {{$class->name}}</h3>
        <h3>Year: 2021</h3>
    </div>   
    <table  width="100%" style="border-spacing: 1em; font-size:30px">
        <thead >
            <tr>                                            
                <td>S/N</td>
                <td>Subject</td>
                <td>First Test</td>
                <td>Second Test</td>
                <td>Exam</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)                                            
                <tr>        
                    <td>{{$sn++}}</td>                                    
                    <td><b>{{$subject->name}}</b></td>
                    <td>{{$subject->first_test ?? "0"}}</td>
                    <td>{{$subject->second_test ?? "0"}}</td>
                    <td>{{$subject->exam ?? "0"}}</td>
                    <td>{{$subject->first_test + $subject->second_test + $subject->exam ?? "0"}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </body><script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</html>