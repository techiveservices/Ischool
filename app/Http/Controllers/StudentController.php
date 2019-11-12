<?php
 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Excel;
use File;
use Illuminate\Support\Facades\Storage;
use PHPExcel_IOFactory;
use PHPExcel_Worksheet_Drawing;
use \App\Student;
use \App\User;
use Illuminate\Support\Facades\Hash;
 
class StudentController extends Controller
{

   /**
     * @var
     */
    protected $excel;
    /**
     * @var
     */
    protected $work_sheet;
    /**
     * @var array
     */
    protected $excel_data = [];
    /**
     * ExcelImport constructor.
     * @param Request $request
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    
    
    public function index2()
    {
        return view('add-student');
    }
    public function index()
    {
        return view('students.index');
    }
 
    public function import(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->file->getRealPath();

                //Excel::selectSheets('sheet1')->load();


                $data = Excel::selectSheets('sheet1')->load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){
 
                    foreach ($data as $key => $value) {
                        $insert[] = [
                        'name' => $value->name,
                        'email' => $value->email,
                        'phone' => $value->phone,
                        ];

                        
                    }
                   //dd($insert);



                    if(!empty($insert)){
 
                        $insertData = DB::table('students')->insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
 
                return back();
 
            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }

    public function import_question(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
         if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->file->getRealPath();
             

              $data_long = Excel::selectSheets('long')->load($path, function($reader) {
                })->get();

          if(!empty($data_long) && $data_long->count()){
 
                    foreach ($data_long as $key => $value) {
                        $insert_long[] = [
                        'access_code_id'=>1,
                        'chapter_id' => 11,
                        'ques_no' => $value->ques_no,
                        'ques' => $value->ques,
                        'ans' => $value->ans,
                        ];

                        
                    }
                 if(!empty($insert_long)){
 
                        $insertData = DB::table('tbl_long_quest')->insert($insert_long);
                       
                    }
                }





         $data_sort = Excel::selectSheets('short')->load($path, function($reader) {
                })->get();


        if(!empty($data_sort) && $data_sort->count()){
 
                    foreach ($data_sort as $key => $value) {
                        $insert_short[] = [
                        'access_code_id'=>1,
                        'chapter_id' => 11,
                        'ques_no' => $value->ques_no,
                        'ques' => $value->ques,
                        'ans' => $value->ans,
                        ];

                        
                    }
                 if(!empty($insert_short)){
 
                   $insertData = DB::table('tbl_sort_question')->insert($insert_short);
                       
                    }
                }






         $data_mcq = Excel::selectSheets('mcq')->load($path, function($reader) {
                })->get();

         if(!empty($data_mcq) && $data_mcq->count()){
 
                    foreach ($data_mcq as $key => $value) {
                        $insert_mcq[] = [
                        'access_code_id'=>1,
                        'chapter_id' => 11,
                        'ques_no' => $value->ques_no,
                        'ques' => $value->ques,
                        'a' => $value->option_a,
                        'b' => $value->option_b,
                        'c' => $value->option_c,
                        'd' => $value->option_d,
                        'ans' => $value->ans,
                        ];

                        
                    }
                 if(!empty($insert_mcq)){
 
                   $insertData = DB::table('tbl_mcq_question')->insert($insert_mcq);
                       
                    }
                }

         $data_true_false = Excel::selectSheets('true_false')->load($path, function($reader) {
                })->get();

        if(!empty($data_true_false) && $data_true_false->count()){
 
                    foreach ($data_true_false as $key => $value) {
                        $insert_tf[] = [
                        'access_code_id'=>1,
                        'chapter_id' => 11,
                        'ques_no' => $value->ques_no,
                        'ques' => $value->ques,
                        'a' => $value->option_a,
                        'b' => $value->option_b,
                        'ans' => $value->ans,
                        ];

                        
                    }
                 if(!empty($insert_tf)){
 
                   $insertData = DB::table('tbl_true_false_question')->insert($insert_tf);
                       
                    }
                }


         $data_fill_blanks = Excel::selectSheets('fill_in_blanks')->load($path, function($reader) {
                })->get();

              if(!empty($data_fill_blanks) &&  $data_fill_blanks->count()){
 
                    foreach ($data_fill_blanks as $key => $value) {
                        $insert_fblanks[] = [
                        'access_code_id'=>1,
                        'chapter_id' => 11,
                        'ques_no' => $value->ques_no,
                        'ques' => $value->ques,
                        'ans' => $value->ans,
                        ];

                        
                    }
                 if(!empty($insert_fblanks)){
 
            $insertData = DB::table('tbl_fill_in_blanks')->insert($insert_fblanks);
                       
                    }
                
              }


               $data_one_word = Excel::selectSheets('one_word')->load($path, function($reader) {
                })->get();

              if(!empty($data_one_word) &&  $data_one_word->count()){
 
                    foreach ($data_one_word as $key => $value) {
                        $insert_one_word[] = [
                        'access_code_id'=>1,
                        'chapter_id' => 11,
                        'ques_no' => $value->ques_no,
                        'ques' => $value->ques,
                        'ans' => $value->ans,
                        ];

                        
                    }
                 if(!empty($insert_one_word)){
 
            $insertData = DB::table('tbl_one_word_question')->insert($insert_one_word);
                       
                    }
                
              }

               $data_match_the_column = Excel::selectSheets('match_the_column')->load($path, function($reader) {
                })->get();

              if(!empty($data_match_the_column) &&  $data_match_the_column->count()){
 
                    foreach ($data_match_the_column as $key => $value) {
                        $insert_match_column[] = [
                        'access_code_id'=>1,
                        'chapter_id' => 11,
                        'ques_no' => $value->ques_no,
                        'sub_a' => $value->sub_a,
                        'col_a' => $value->col_a,
                        'sub_b' => $value->sub_b,
                        'col_b' => $value->col_b,
                        'ans' => $value->ans,
                        ];

                        
                    }
                 if(!empty($insert_match_column)){
 
            $insertData = DB::table('tbl_match_column_question')->insert($insert_match_column);
                       
                    }
                
              }
          

         return back();

      }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }


    }

    public function import_student(Request $request){

    $this->excel = PHPExcel_IOFactory::load($request->file('file'));
        //Get active sheet
        $this->work_sheet = $this->excel->getSheetNames();

      
        if($this->work_sheet[0]=='Sheet1'){
          //Iterate through drawing collection
            $this->work_sheet = $this->excel->getSheet(0);
             $i = 0;
        foreach ($this->work_sheet->getDrawingCollection() as $drawing) {
            //check if it is instance of drawing
            if ($drawing instanceof PHPExcel_Worksheet_Drawing) {
                //creating image name with extension
                $file_name = str_replace(' ', '_', $drawing->getName()).'.'.$drawing->getExtension();
                //Get image contents from path and store them in Laravel storage
              
                Storage::put('public/'.$file_name, file_get_contents($drawing->getPath()));
                //create images array initially
                $this->excel_data[] = [
                    'image' => $file_name,
                    'image2' => $file_name,
                    
                ];
            }
        }
        //Map other data present in work sheet
        $firstsheet_record= $this->rowData();
         //print_r($firstsheet_record);
        DB::table('student_info')->insert($firstsheet_record);

       }
       

         $this->work_sheet1 = $this->excel->getSheet(1);

         $secondsheet_record=   $this->rowData2();

          DB::table('student_info2')->insert($secondsheet_record);


          

        
       }

     private function rowData()
    {
        $i = 0;
        //Iterate through row by row
        foreach ($this->work_sheet->getRowIterator(2) as $row) {
            //iterate through cell by cell of row
            foreach ($row->getCellIterator() as $cell) {
                //In case of image data that would be null continue
                //We have already populated them in array
                if(is_null($cell->getValue())){continue;}
                //Map other excel data into the array
                $this->excel_data[$i]['name'] = $cell->getValue();
            }
            $i++;
        }
        //Return final data array
        return $this->excel_data;




    }
     private function rowData2()
    {
         $i = 0;
        //Iterate through row by row
        foreach ($this->work_sheet1->getRowIterator(2) as $row) {
            //iterate through cell by cell of row
            foreach ($row->getCellIterator() as $cell) {
                //In case of image data that would be null continue
                //We have already populated them in array
                if(is_null($cell->getValue())){continue;}
                //Map other excel data into the array
                $this->excel_data1[$i]['age'] = $cell->getValue();
                $this->excel_data1[$i]['gender'] = $cell->getValue();
            }
            $i++;
        }
        //Return final data array
        return $this->excel_data1;


    }
 public function add_student(Request $request){

   $user_type=$request->user_type;
   $publisher_id=$request->publisher_id;
   $pub_id=$request->p_id;
   if($user_type=='2'){
    $p_id=$publisher_id;
   }elseif ($user_type=='1') {
       $p_id=$pub_id;
   }
   $school=$request->school;
   $name=$request->name;
   $phone=$request->phone_no;
   $email=$request->email;

     $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $mypass= substr(str_shuffle($chars),0,6);

    $new_user=new User();
    $new_user->name=$name;
    $new_user->email=$email;
    $new_user->password=Hash::make($mypass);
    $new_user->account_type=5;
    $new_user->save();

     $stu_obj= new Student();
     $stu_obj->user_id=$new_user->id;
     $stu_obj->p_id=$p_id;
     $stu_obj->school_id=$school;
     $stu_obj->name=$name;
     $stu_obj->email=$email;
     $stu_obj->password=$mypass;
     $stu_obj->phone=$phone;
     $stu_obj->save();

       return redirect()->back()->with('success', ['Student Added Successfully']);  
     }
 
 public function edit_student(Request $request){
   $id=$request->id;
   $user_type=$request->user_type;
   $publisher_id=$request->publisher_id;
   $pub_id=$request->p_id;
   $school=$request->student_school;
   $school_id=$request->school;
   if($user_type!='2'){

    $p_id=$pub_id;
    $s_id=$school_id;
   }else{
    $p_id=$publisher_id;
    $s_id=$school;
   }
   $name=$request->name;
   $phone=$request->phone_no;
   $email=$request->email;
     $stu_obj=\App\Student::find($id);
     if($p_id!=''){
      $stu_obj->p_id=$p_id;

     }
     if($s_id!=''){
      $stu_obj->school_id=$s_id;

     }
     $stu_obj->name=$name;
     $stu_obj->email=$email;
     $stu_obj->phone=$phone;
     $stu_obj->save();

       return redirect()->back()->with('success', ['Updated Successfully']);  
  

 }
     
}
