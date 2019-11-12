
@extends('school_dashboard.include.dashboard_head')
@section('content')
<div class="container mt-5" >
	<div class="row">
        <div class="col-md-12">
      <table id="view_test_paper_list" class="display" style="width:98%">
        <thead>
            <tr>
                <th>Class</th>
                <th>Subject</th>
                <th>Title</th>
                <th>Date Of Exam</th>
                <th>Pdf File</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>

    @if($user_id!='')
       <?php
          $test_list=\App\TestPaper::where('user_id','=',$user_id)->orderBy('id','DESC')->get();
       ?>
          @if(!empty($test_list))
            @foreach($test_list as $list)
              <tr>
                <td>{{ $list->class_id }}</td>
                <td>{{ $list->subject }}</td>
                <td>{{ $list->title }}</td>
                <td>{{ $list->paper_date }}</td>
                <td><a href="{{ asset('pdf/test_paper/') }}/{{ $list->pdf_file }}">Download</a></td>
                <td>{{ $list->created_at }}</td>
            </tr>

            @endforeach
          @endif

    @endif

           
          
           
        </tbody>
        <tfoot>
            <tr>
                <th>Class</th>
                <th>Subject</th>
                <th>Title</th>
                <th>Date Of Exam</th>
                <th>Pdf File</th>
                <th>Created Date</th>
            </tr>
        </tfoot>
    </table>


        </div>


	</div>
</div>



    @endsection