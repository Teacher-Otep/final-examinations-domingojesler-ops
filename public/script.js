document.addEventListener("DOMContentLoaded", () => {
    window.showSection = function(id){
        document.querySelectorAll('.content').forEach(s => s.style.display = 'none');
        document.querySelector('.homecontent').style.display = 'none';
        document.getElementById(id).style.display = 'block';

        const url = new URL(window.location);
        url.searchParams.set('section', id);
        history.pushState({}, '', url);
    }

    document.getElementById('logo').onclick = () => {
        document.querySelectorAll('.content').forEach(s => s.style.display = 'none');
        document.querySelector('.homecontent').style.display = 'block';
    }

    const urlParams = new URLSearchParams(window.location.search);

    if(urlParams.get('status') == 'added'){
        alert("✅ Student Successfully Added!");
    }

    if(urlParams.get('status') == 'error_id'){
        alert("❌ ID already exists!");
    }

    if(urlParams.get('status') == 'error_name'){
        alert("⚠️ Student name already exists!");
    }

    $('#load_data_btn').click(function(){
        var student_id = $('#search_id').val();

        if(student_id == ''){
            alert("Please enter ID Number!");
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../includes/fetch_student.php',
            data: {id: student_id},
            success: function(response){
                if(response == 'not_found'){
                    alert("Student not found!");
                    $('#update_form_area').html('');
                } else {
                    $('#update_form_area').html(response);
                }
            }
        });
    });

    $('#delete_id_input').on('keyup', function(){
        var student_id = $(this).val();

        if(student_id == ''){
            $('#delete_student_info').html('');
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../includes/fetch_student_display.php',
            data: {id: student_id},
            success: function(response){
                if(response == 'not_found'){
                    $('#delete_student_info').html('<p class="no-data">No student found.</p>');
                } else {
                    $('#delete_student_info').html(response);
                }
            }
        });
    });


    $('#delete_btn').click(function(){
        var student_id = $('#delete_id_input').val();

        if(student_id == ''){
            alert("Please enter ID Number!");
            return;
        }

        if(confirm("❗ Are you sure you want to DELETE this student record?")){
            $.ajax({
                type: 'POST',
                url: '../includes/delete_ajax.php',
                data: {id: student_id},
                success: function(response){
                    alert("✅ Student deleted successfully!");
                    $('#delete_id_input').val('');
                    $('#delete_student_info').html('');
                }
            });
        }
    });

    $(document).on('input', 'input[type="text"]', function() {
        if($(this).hasClass('search-field') || $(this).attr('name') == 'id'){
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });


    if(urlParams.get('section')){
        showSection(urlParams.get('section'));
    }

});
