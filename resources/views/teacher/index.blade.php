<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Laravel 8 Ajax Crud App</title>
  </head>
  <body>
    <div class="container pt-5">
      <h2>
        <marquee behavior="" direction="">Laravel 8 Ajax Crud Application</marquee>
      </h2>
      <div class="row pt-5">
        <div class="col-sm-8">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">All Teacher</h5>
            </div>
            <div class="card-body">
              <table id="table_id" class="display table table-borderless ">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Titile</th>
                        <th>Institute</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td>Row 1 Data 1</td>
                        <td>Row 1 Data 2</td>
                        <td>Row 1 Data 2</td>
                        <td>Row 1 Data 2</td>
                        <td>
                          <a href="" class="btn btn-outline-success"> <i class="fas fa-edit"></i></a>
                          <a href="" class="btn btn-outline-danger"> <i class="fas fa-trash"></i></a>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title" id="addTeacher">Add New Teacher</h5>
              <h5 class="card-title" id="updateTeacher">Add New Teacher</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Enter Your Name">
                  <span class="text-danger" id="nameError"></span>
                </div>
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" class="form-control" id="title" placeholder="Enter Your Titile"r">
                  <span class="text-danger" id="titleError"></span>
                </div>
                <div class="form-group">
                  <label for="institute">Institute</label>
                  <input type="text" name="institute" class="form-control" id="institute" placeholder="Enter Your Institute's Name"r">
                  <span class="text-danger" id="instituteError"></span>
                </div>
                <input type="hidden" id="id">
                <div class="form-group text-center">
                  <button type="submit" onclick="addData()" class="btn btn-primary"id="addButton">Add</button>
                  <button type="submit" onclick="updateData()" class="btn btn-primary"id="updateButton">Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      <script type="text/javascript">
        
        $('#addTeacher').show();
        $('#updateTeacher').hide();
        $('#addButton').show();
        $('#updateButton').hide();

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      //================== Start Show All Data from Database ================
        function allData(){
          $.ajax({
            type:"GET",
            dataType:"json",
            url:"/teacher/all",
            success: function(response){
              var data = ""
              $.each(response, function(key, value){
                data = data + "<tr>"
                data = data + "<td>"+value.id+"</td>"
                data = data + "<td>"+value.name+"</td>"
                data = data + "<td>"+value.title+"</td>"
                data = data + "<td>"+value.institute+"</td>"
                data = data + "<td>"
                data = data + "<a class='btn btn-outline-success mr-2' onclick='editData("+value.id+")' > <i class='fas fa-edit'></i></a>"
                data = data + "<a class='btn btn-outline-danger' onclick='deleteData("+value.id+")'> <i class='fas fa-trash'></i></a>"
                data = data + "</td>"
                data = data + "</tr>"
              })
               $('tbody').html(data);
        
          }
        })
        }
        allData();
 //================== End Show All Data from Database ================


 //================== Start Clear Data from  input Form ================
        function clearData(){
          $('#name').val('');
          $('#title').val('');
          $('#institute').val('');
        }
  //================== End Clear Data from  input Form ================


   //================== Start Add Data into Database ================
        function addData(){
          var name = $('#name').val();
          var title = $('#title').val();
          var institute = $('#institute').val();

          $.ajax({
            type:"POST",
            dataType:"json",
            data:{name:name, title:title, institute:institute, _token: '{{csrf_token()}}'},
            url:"/teacher/store",
            success: function(data){
              swal({
                  title: "Success!",
                  text: "Data added successfully!",
                  icon: "success",
                  button: "Close!",
                });
              clearData();
              allData();
              console.log('successfully added');
            },
            error: function(error){
              // $('#nameError').text('error.responeJson.errors.name');
           
            }
          })
        }

 //================== End Add Data into Database ================

 //================== Start Edit Data ================

        function editData(id){
          $.ajax({
            type: "GET",
            dataType: "json",
            url: "/teacher/edit/"+id,
            success: function (data){
              $('#addTeacher').hide();
              $('#updateTeacher').show();
              $('#addButton').hide();
              $('#updateButton').show();
              $('#id').val(data.id);
              $('#name').val(data.name);
              $('#title').val(data.title);
              $('#institute').val(data.institute);
            }
          })
        }
//================== End Edit Data ================

//================== End Update Data  ================

        function updateData(){
          var id = $('#id').val();
          var name = $('#name').val();
          var title = $('#title').val();
          var institute = $('#institute').val();

          $.ajax({
            type: "POST",
            dataType: "json",
            data:{name:name, title:title, institute:institute, _token: '{{csrf_token()}}'},
            url: "/teacher/update/"+id,
            success: function(data){
              swal({
                  title: "Success!",
                  text: "Data updated successfully!",
                  icon: "success",
                  button: "Close!",
                });
              $('#addTeacher').show();
              $('#updateTeacher').hide();
              $('#addButton').show();
              $('#updateButton').hide();
              clearData();
              allData();
              console.log(data);
            }
          })
        }
//================== End Update Data  ================

//================== Start Delete Data from Database ================
        function deleteData(id){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                  type: "GET",
                dataType: "json",
                url: "/teacher/delete/"+id,
                success:function(date){  
                  allData();
            }
          })
        swal("Poof! Your data has been deleted!", {
          icon: "success",
        });
      } else {
        swal("Your data is safe!");
      }
    });




         
        }

//================== End Dele Data from Database ================
      </script>
  </body>
</html>