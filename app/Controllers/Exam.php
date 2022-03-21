<?php
namespace App\Controllers;
class Exam extends BaseController{
	
    public function index($exam_id){
		

		helper(['form']);
        $model = new \App\Models\ExamModel();
        
		
			$data=[
				'title'=>"exam",
				
			];
			
			$data['exam'] = $model->GetExamInfo($exam_id);
			$data['questions'] = $model->GetExamQuestions($exam_id);
			$data['noq'] = $model->pagination($exam_id);
			// $data['NandP'] = $model->next_N_prev($exam_id);
			$data["ignm"]=1;
			if($this->request->getMethod() == "post"){
				if($this->request->getPost('SubAnswers')){
					if(isset($_POST['answer'])){
						foreach($_POST['answer'] as  $key => $value){
							$model->insertanswers($key,$value,$exam_id,session()->get('student_id'));
						}	
					}

					unset($_SESSION['SubExam']);
				}
				session()->setFlashdata('submit','Your Answers Submitted');
				return redirect()->to("/student/exams");
		
		    }



        return view(stu_exam,$data);

    }



	public function exam_info($exam_id){
		$model = new \App\Models\ExamModel();
		$data=[
            'title'=>"exam",
        ];
        $data['exam'] = $model->GetExamInfo($exam_id);
		$data['noq'] = $model->pagination($exam_id);

		if($this->request->getMethod() == 'post'){
			if($this->request->getPost('subexam')){
				$d=[
					"SubExam"=> $exam_id,
				];
				session()->set($d);
				if($model->attendance($exam_id,session()->get('student_id'))){
				return redirect()->to("/student/exam/$exam_id");
			    }else{
					session()->setFlashdata('enroll','Not Allowed!<br> You already attended This exam');	
					return redirect()->to("/student/exams");
				}
		    }
			
		}


		return view(stu_exam_info,$data);
	}

    public function exams(){
        $model = new \App\Models\ExamModel();
        $data=[
            'title'=>"Exams",
            'exams'=>$model->GetStuExams(session()->get('student_id')),
            
        ];
        // $data['exam'] = $model->GetExamInfo($exam_id);


          return view(stu_exams,$data);
    }




    


}

?>
