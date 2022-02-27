<?php
namespace App\Controllers;
class Student extends BaseController
{
    public function index()
    {
        return redirect()->to('/student/home');
    }


    public function home()
    {
        
        $data=[
            
            'title'=>"Home",
        ];
        return view(stu_welcome_message,$data);
    }

    
    public function courses(){
        $model = new \App\Models\CourseModel();
        $data=[
            'title'=>"Courses",
            'courses'=>$model->GetStuCourses(session()->get('student_id')),
        ];
        return view(stu_courses,$data);
    }



    public function exams(){
        $model = new \App\Models\ExamModel();
        $data=[
            'title'=>"Exams",
            'exams'=>$model->GetStuExams(session()->get('student_id'))
        ];

          return view(stu_exams,$data);
    }

    public function report(){
        $model = new \App\Models\ExamModel();
        $data=[
            'title'=>"Report",
            'exams'=>$model->GetStuExams(session()->get('student_id'))

        ];
        return view(stu_report,$data);
    }

    public function profile(){
        $model = new \App\Models\StudentModel();
        
        $data=[
            'title'=>"Profile",
            'student' => $model->where('student_id', session()->get('student_id'))->first(),

        ];
        
        return view(stu_profile,$data);
    }

    public function update(){
        $data=[
            'title'=>"Update Data",
        ];

        helper(['form']);
        $model = new \App\Models\StudentModel();

        if($this->request->getMethod() == 'post') {
			$rules=[
                'student_fname'=>'required|min_length[3]|max_length[20]',
                'student_lname'=>'required|min_length[3]|max_length[20]',
                'student_BD'=>'required',
                
            ];
			if(! $this->validate($rules)){
                $data['validation']= $this->validator;

            }else{
               
                $newdata=[
                    'student_id'=> session()->get('student_id'),
                    'student_fname'=> $this->request->getPost('student_fname'),
                    'student_lname'=> $this->request->getPost('student_lname'),
                    'student_BD'=> $this->request->getPost('student_BD'),
                    
                ];
				$model->save($newdata);
                session()->set($newdata);
                session()->setFlashdata('success','Uplaoded Successfully');
                return redirect()->to('student/profile');
			}

		}

        $data['student'] = $model->where('student_id', session()->get('student_id'))->first();
        
        return view(stu_edit_profile,$data);
    }
    
    public function update_pic(){
        $model = new \App\Models\StudentModel();
        
        
        
        helper(['form']);

        if($this->request->getMethod() == 'post') {
			$rules=[
                "student_pic"=>"uploaded[student_pic]|is_image[student_pic]",
                
            ];
			if(! $this->validate($rules)){
                $data['validation']= $this->validator;

            }else{

                 $file = $this->request->getFile('student_pic');
                 if($file->isValid() && !$file->hasMoved()){
                   
                    $file->move('./uploads/students/', $file->getRandomName());
                 }

                 $pic_name = $file->getname();
                 
                 
                $newdata=[
                    'student_id'=> session()->get('student_id'),
                    'student_pic'=> $pic_name,
                    
                ];
                
				 $model->save($newdata);
                
                
                 session()->setFlashdata('success','Photo Uplaoded Successfully');
                return redirect()->to('student/profile');
			}

		}
        $data=[
            'title'=>"Update Data",
            'student' => $model->where('student_id', session()->get('student_id'))->first(),

        ];
        
        return view(stu_edit_profile,$data);
    }

    public function del_pic(){
        $model = new \App\Models\StudentModel();
        $student = $model->where('student_id', session()->get('student_id'))->first();
       


        
        helper(['form']);
        
        

        
			if($student['student_pic']){
                
                if(file_exists("./uploads/students/".$student['student_pic'])){

                    unlink("./uploads/students/".$student['student_pic']);
                }


                $newdata = [
                    'student_id'=> session()->get('student_id'),
                    'student_pic'=> '',
                ];
                
                $model->save($newdata);
                 session()->setFlashdata('success','Photo deleted Successfully');
                return redirect()->to('student/profile');

            }else{
                session()->setFlashdata('failed','No Photos Found');
                return redirect()->to('student/update');

            }

		
        
        return redirect()->to('student/update');
    }


    

    
    


    public function resetpassword(){
        $data=[
            'title'=>"Reset Password",
        ];

        helper(['form']);
        $model = new \App\Models\StudentModel();

        if($this->request->getMethod() == 'post') {
			$rules=[
                'current_password'=>'required|min_length[3]|max_length[20]',
                'student_password'=>'required|min_length[3]|max_length[20]',
                'password_confirm'=>'matches[student_password]',
                
            ];

            $errors = [
                'current_password'=>[
                    'required'=>'The Current Password field required',
                    'min_length'=>'The Current Password field min length = 5',
                    'max_length'=>'The Current Password field max length = 20',

                ],

                'student_password'=>[
                    'required'=>'The New Password field required',
                    'min_length'=>'The New Password field min length = 5',
                    'max_length'=>'The New Password field max length = 20',
                ],

                'password_confirm'=>[
                    'matches'=>'The new pass_confirm doesn\'t match new password field',
                ]
                
            ];
		

            if(! $this->validate($rules,$errors)){
                $data['validation']= $this->validator;

            }
            else{
                $user = $model->where('student_id',session()->get('student_id'))
                              ->first();

                $newdata['student_id']= session()->get('student_id');
                if(password_verify($this->request->getPost('current_password') ,$user['student_password']) ){

                $newdata['student_password'] = $this->request->getPost('student_password');

				$model->save($newdata);
                
                session()->setFlashdata('success','Uplaoded Successfully');
                return redirect()->to('student/resetpassword');
                }else{
                session()->setFlashdata('failed','current Password not correct');
                return redirect()->to('student/resetpassword');
                }
			
                
			}

		}

        $data['student'] = $model->where('student_id', session()->get('student_id'))->first();  
        return view(stu_resetpassword,$data);
    }
    

    
}
