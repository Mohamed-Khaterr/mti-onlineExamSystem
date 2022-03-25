


<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Create Exam</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
            
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="" href="index.html">Home</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="" href="#">Exams</a>
						</li>
            <li><i class='bx bx-chevron-right' ></i>
							<a class="" href="#">Create Exam</a>
						</li>

                        <li><i class='bx bx-chevron-right' ></i>
							<a class="active" href="#">Edit Exam</a>
						</li>
						
					</ul>
				</div>
				
			</div>



			<ul class="box-info">
				<li>
					<i class='bx bx-layer'></i>
					<span class="text">
						<h3><?= $exam['course_name'] ?></h3>
						<p>Course Name</p>
					</span>
				</li>
				
				<li>
					<i class='bx bx-task'></i>
					<span class="text">
						<h3><?= $exam['title'] ?></h3>
						<p>Exam Title</p>
					</span>
				</li>
				
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
						<h3><?= $exam['dateTime'] ?></h3>
						<p>Date & Time</p>
					</span>
				</li>
			</ul>

			
			
			
			<div class="table-data todo">
				<div class="order  p-0">
					

                    <div class="todo d-flex justify-content-center center ">
                         <h3 >  Questions  </div>                        
                    </div>
                </div>
			</div>

			<?php foreach($questions as $question): ?>
				<?php if(!empty($question['options'][0])): ?>
					<div class="table-data ">
						<div class="order ">
							<p>
								<?= $question['question'] ?>
							</p>
							
							<div class="d-flex justify-content-around">
								<?php foreach($question['options'] as $option): ?>
									<div class="form-check">
										<input class="form-check-input" type="radio" disabled  <?= $question['answer'] == $option ? 'checked' : null ?> >
										<label class="form-check-label">  <?= $option ?> </label>
									</div>
								<?php endforeach; ?>
							</div>

							<div class="d-flex justify-content-end mt-3">
								<button type="submit" class="btn btn-primary " onclick=" MCQ_edit()">Edit </button>
								<button type="submit" class="btn btn-danger ms-1">Delete</button>
							</div>                
								
						</div>
					</div>
				<?php else: ?>
					<div class="table-data ">
						<div class="order "> 
							<p>
								<?= $question['question'] ?>
							</p>
							
							<div class="form-check ">

								<input class="form-check-input" type="radio" disabled <?= $question['answer'] == 'True' ? 'checked' : null ?>  >
								<label class="form-check-label">  True </label>
							</div>
							
							<div class="form-check">
								<input class="form-check-input" type="radio" disabled <?= $question['answer'] == 'False' ? 'checked' : null ?>>
								<label class="form-check-label" > False</label>
							</div>
							
							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-primary " onclick="true_false_edit()">Edit </button>
								<button type="submit" class="btn btn-danger ms-1">Delete</button>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>



        


            


            <!-- box belong edit Choise Question -->
       
            <section id="fixedBox" class=" w-100 vh-100 d-flex align-items-center justify-content-center  d-none ">

                <div id="smallBox" class=" bg-body  w-75 h-75">
                    <i id="closeBtn" class=" bx bxs-x-circle mt-2" ></i>

              

                    <div id="editbox"  class = " p-3"  >


                        <div class="col-md-12">
                            <label for="inputCity" class="form-label">Question</label>
                            <textarea type="" class="form-control" id="inputCity"></textarea>
                         </div>


                         <div class="d-flex justify-content-between mt-3">

                            <div class="col-md-3">
                              <label for="inputCity" class="form-label">Choise : 1 </label>
                              <input type="" class="form-control" id="inputCity">
                           </div>
  
                           <div class="col-md-3">
                              <label for="inputCity" class="form-label">Choise : 2</label>
                              <input type="" class="form-control" id="inputCity">
                           </div>
  
                           <div class="col-md-3">
                            <label for="inputCity" class="form-label">Choise : 3</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>
  
                          </div>
                        

                        <div class="d-flex justify-content-between mt-3">

                          <div class="col-md-3">
                            <label for="inputCity" class="form-label">Correct Anwser</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>

                         <div class="col-md-3">
                            <label for="inputCity" class="form-label">Question Grade</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>

                         <div class="col-md-3">
                            <label for="inputState" class="form-label">Exams </label>
                            <select id="inputState" class="form-select">
                              <option disabled selected>Choise...</option>
                              <option>Database</option>
                              <option>Computer Graphic</option>

                            </select>
                          </div>

                        </div>


                         <div class="d-flex justify-content-between mt-4">

                         <div class="">
                            <label for="inputCity" class="form-label"> Is Correct Anwser ?</label>
                            <input type="checkbox" class="" id="">
                         </div>


                         <div class=" ">
                            <button type="submit" class="btn btn-primary">Add Choise </button>
                            <button type="submit" class="btn btn-primary">Save</button>


                          </div>

                        </div>


                    </div>

					





              
                </div>
                
              </section>





            <!-- box belong edit True and false Question -->


              <section id="fixedB" class=" w-100 vh-100 d-flex align-items-center justify-content-center d-none ">

                <div id="smallB" class=" bg-body  w-75 h-75">
                    <i id="closeB" class=" bx bxs-x-circle mt-2" ></i>

              

                    <div  class = " p-3"  >


                        <div class="col-md-12">
                            <label for="inputCity" class="form-label">Question</label>
                            <textarea type="" class="form-control" id="inputCity"></textarea>
                         </div>



                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              True
                            </label>
                          </div>
                        
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                False
                            </label>
                          </div>

                        <div class="d-flex justify-content-between mt-3">

                          <div class="col-md-3">
                            <label for="inputCity" class="form-label">Correct Anwser</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>

                         <div class="col-md-3">
                            <label for="inputCity" class="form-label">Question Grade</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>

                         <div class="col-md-3">
                            <label for="inputState" class="form-label">Exams </label>
                            <select id="inputState" class="form-select">
                              <option disabled selected>Choise...</option>
                              <option>Database</option>
                              <option>Computer Graphic</option>

                            </select>
                          </div>

                        </div>


                         <div class="d-flex justify-content-between mt-4">


							 <div class=" ">
								<button type="submit" class="btn btn-primary">Save</button>

							  </div>

                        </div>


                    </div>

					





              
                </div>
                
              </section>



            

		</main>
		<!-- MAIN -->