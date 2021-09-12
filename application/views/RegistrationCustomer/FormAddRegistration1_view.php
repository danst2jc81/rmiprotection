<script>
    $(document).ready(function(){
        $("#prospective_student_type").change(function(){
            var prospective_student_type        = $("#prospective_student_type").val();
            var name                            = "prospective_student_number";
            var value                           = "-";

            // alert(prospective_student_type);

            // console.log(value);

            if (prospective_student_type == 1 || prospective_student_type == 9){
               function_elements_add(name, value);
            }

        });
    });

    $(document).ready(function(){
        $("#prospective_student_category").change(function(){
            var prospective_student_category        = $("#prospective_student_category").val();

            var school_refferal = document.getElementById("school_refferal");

            if (prospective_student_category == 0 || prospective_student_category == 9 || prospective_student_category == 2){
                school_refferal.style.display = "none";
            } else {
                school_refferal.style.display = "block";
            }

        });
    });


    $(document).ready(function(){
        $("#prospective_student_class").change(function(){
            var prospective_student_class = $("#prospective_student_class").val();

            var student_class = document.getElementById("student_class");

            if (prospective_student_class == 0 || prospective_student_class == 9){
                student_class.style.display = "none";
            } else {
                student_class.style.display = "block";
            }

        });
    });

</script>

<?php 
    $year_now   =   date('Y');

    $year[$year_now+1] = 'Pilih Tahun';

    for($i = $year_now; $i>($year_now-69); $i--){
        $year[$i] = $i;
    } 

    $unique     = $this->session->userdata('unique');
    $data       = $this->session->userdata('addRegistration-'.$unique['unique']);

   /* print_r("data ");
    print_r($data);*/

?>


<div class="tab-pane active" id="tab1">
    <h3 class="block">Program Studi Mahasiswa</h3>
    
	<div class = "row">
        <div class = "col-md-6">
            <div class="form-group form-md-line-input">
                <?php 
                    echo form_dropdown('prospective_student_type', $prospectivestudenttype, set_value('prospective_student_type', $data['prospective_student_type']),'id="prospective_student_type", class="form-control select2me" onChange="function_elements_add(this.name, this.value); ProspectiveStudentTypeConfirmation(this.value);"');
                ?>
                <label class="control-label">Tipe
                    <span class="required"> * </span>
                </label>
            </div>
        </div>
    

        <div class = "col-md-6">
            <div class="form-group form-md-line-input">
                <?php 
                    echo form_dropdown('prospective_student_category', $prospectivestudentcategory, set_value('prospective_student_category', $data['prospective_student_category']),'id="prospective_student_category", class="form-control select2me" onChange="function_elements_add(this.name, this.value); ProspectiveStudentCategoryConfirmation(this.value);"');
                ?>
                 <label class="control-label">Kategori
                 <span class="required"> * </span>
                 </label>
            </div>
        </div>
    </div>      
   
    <?php 
        if ($data['prospective_student_category'] == 0 || $data['prospective_student_category'] == 9 || $data['prospective_student_category'] == 2){
    ?>
            <div id="school_refferal" style="display:none;">
    <?php 
        } else {
    ?>      
            <div id="school_refferal" style="display:block;">
    <?php 
        }
    ?>
        <div class = "row">
            <div class = "col-md-6">
                <div class="form-group form-md-line-input"> 
                    <input type="text" class="form-control" id="prospective_student_origins_school" name="prospective_student_origins_school" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['prospective_student_origins_school']?>"/>
                    <span class="help-block"> Isikan Nama Sekolah / Instansi Kerja Anda </span>
                    <label class="control-label">Nama Sekolah / Instansi Kerja ( wajib di isi )</label>
                </div>
            </div>

            <div class = "col-md-6">
                <div class="form-group form-md-line-input"> 
                    <input type="text" class="form-control" id="prospective_student_origins_teacher" name="prospective_student_origins_teacher" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['prospective_student_origins_teacher']?>"/>
                    <span class="help-block"> Isikan Nama Guru Anda </span>
                    <label class="control-label">Nama Guru yang Merekomendasikan ( wajib di isi )</label>
                </div>
            </div>
        </div>
    </div>

    
    <div class = "row">
        <div class = "col-md-6">
            <div class="form-group form-md-line-input">
                <?php 
                    echo form_dropdown('prospective_student_class', $prospectivestudentclass, set_value('prospective_student_class', $data['prospective_student_class']),'id="prospective_student_class", class="form-control select2me" onChange="function_elements_add(this.name, this.value); ProspectiveStudentClass(this.value);"');
                ?>
                <label class="control-label">Kelas
                    <span class="required"> * </span>
                </label>
            </div>
        </div>

        <?php 
            if ($data['prospective_student_class'] == 0 || $data['prospective_student_class'] == 9){
        ?>
                <div id="student_class" style="display:none;">
        <?php 
            } else {
        ?>      
                <div id="student_class" style="display:block;">
        <?php 
            }
        ?>
            <div class = "col-md-6">
                <div class="form-group form-md-line-input">
                    <label class="control-label"><h4><b>Hanya Untuk Karyawan / yang sudah bekerja</b></h4></label>
                </div>
            </div>
        </div>
    </div>

    <div class = "row">
        <div class = "col-md-6">
            <div class="form-group form-md-line-input">
                <?php 
                    echo form_dropdown('faculty_id1', $corefaculty, set_value('faculty_id1', $data['faculty_id1']),'id="faculty_id1", class="form-control select2me" onChange="function_elements_add(this.name, this.value); FacultyID1Confirmation(this.value);""');
                ?>
                <label class="control-label">Fakultas 1
                    <span class="required"> * </span>
                </label>
            </div>
        </div>

        <div class = "col-md-6">
            <div class="form-group form-md-line-input">
                <?php
                    if (!empty($data['faculty_id1'])){
                        $coreprogram = create_double($this->Registration_model->getCoreProgram($data['faculty_id1']), 'program_id', 'program_name');

                        echo form_dropdown('program_id1', $coreprogram, set_value('program_id1', $data['program_id1']),'id="program_id1", class="form-control select2me" onChange="function_elements_add(this.name, this.value);" ProgramID1Confirmation(this.value);"');
                    } else {
                ?>
                    <select name="program_id1" id="program_id1" class="form-control select2me" onChange="function_elements_add(this.name, this.value); ProgramID1Confirmation(this.value);"">
                        <option value=""></option>
                    </select>
                <?php
                    }
                ?>
                <label class="control-label">Program Studi 1
                    <span class="required"> * </span>
                </label>
            </div>
        </div>
    </div>

     <div class = "row">
        <div class = "col-md-6">
            <div class="form-group form-md-line-input">
                <?php 
                    echo form_dropdown('faculty_id2', $corefaculty, set_value('faculty_id2', $data['faculty_id2']),'id="faculty_id2", class="form-control select2me" onChange="function_elements_add(this.name, this.value); FacultyID2Confirmation(this.value);""');
                ?>
                <label class="control-label">Fakultas 2
                    <span class="required"> * </span>
                </label>
            </div>
        </div>

        <div class = "col-md-6">
            <div class="form-group form-md-line-input">
                <?php
                    if (!empty($data['faculty_id2'])){
                        $coreprogram = create_double($this->Registration_model->getCoreProgram($data['faculty_id2']), 'program_id', 'program_name');

                        echo form_dropdown('program_id2', $coreprogram, set_value('program_id2', $data['program_id2']),'id="program_id2", class="form-control select2me" onChange="function_elements_add(this.name, this.value); ProgramID2Confirmation(this.value);""');
                    } else {
                ?>
                    <select name="program_id2" id="program_id2" class="form-control select2me" onChange="function_elements_add(this.name, this.value); ProgramID2Confirmation(this.value);"">
                        <option value=""></option>
                    </select>
                <?php
                    }
                ?>
                <label class="control-label">Program Studi 2
                    <span class="required"> * </span>
                </label>
            </div>
        </div>
    </div>
</div>


                                                    