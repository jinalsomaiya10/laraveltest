@extends('layouts.devlayout')
@section('content')
<a href="{{ route('developers.create') }}" class="btn btn-success mb-2">Add</a>
<a href="javascript:void(0);" data-url="{{ url('deveoper-delete-selected') }}" class="btn btn-success delete_all mb-2 ml-2">Delete All Selected</a>
<br>
<div class="row">
<div class="col-12">
<table class="table table-bordered" id="laravel_crud">
<thead>
<tr>
<th><input type="checkbox" id="master"></th>
<th>#</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Phone No.</th>
<th>Address</th>
<td colspan="2">Action</td>
</tr>
</thead>
<tbody>
@foreach($developers as $developer)
<tr id="tr_{{$developer->id}}">
<td><input type="checkbox" class="sub_chk" data-id="{{$developer->id}}"></td>
<td>{{ $loop->index + 1 }}</td>
<td>{{ $developer->first_name }}</td>
<td>{{ $developer->last_name }}</td>
<td>{{ $developer->email }}</td>
<td>{{ $developer->phone_number }}</td>
<td>{{ $developer->address }}</td>
<td><a href="{{ route('developers.edit',$developer->id)}}" class="btn btn-primary">Edit</a></td>
<td>
<form action="{{ route('developers.destroy', $developer->id)}}" method="post">
{{ csrf_field() }}
@method('DELETE')
<button class="btn btn-danger" type="submit">Delete</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
{!! $developers->links('pagination::bootstrap-4') !!}
</div> 
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {

        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


        $('.delete_all').on('click', function(e) {

            let allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  
                let check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  

                	let join_selected_values = allVals.join(","); 

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });
    });
</script>
@endpush