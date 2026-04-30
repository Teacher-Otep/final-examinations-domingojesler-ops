document.addEventListener("DOMContentLoaded", () => {

    window.showSection = function(id){
        document.querySelectorAll('.content').forEach(s=>s.style.display='none');
        document.querySelector('.homecontent').style.display='none';
        document.getElementById(id).style.display='block';
        const url = new URL(window.location);
        url.searchParams.set('section', id);
        history.pushState({},'',url);
    }

    document.getElementById('logo').onclick = () => {
        document.querySelectorAll('.content').forEach(s=>s.style.display='none');
        document.querySelector('.homecontent').style.display='block';
    }

    window.clearFields = () => {
        document.querySelectorAll('#create input').forEach(i=>i.value='');
    }

    // --- UPDATE FUNCTIONALITY ---
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
                    alert("Student ID not found!");
                    $('#update_form_area').html('');
                } else {
                    $('#update_form_area').html(response);
                }
            }
        });
    });

    // --- DELETE FUNCTIONALITY ---
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
                }
            });
        }
    });

    // Number only validation
    $(document).on('input', 'input[type="text"]', function() {
        if($(this).hasClass('search-field') || $(this).attr('name') == 'id'){
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });

    // Error Messages
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.get('status') == 'error_id'){
        alert("❌ Error: ID Number already exists! Use another ID.");
    }
    if(urlParams.get('status') == 'error_name'){
        alert("⚠️ Warning: This student name already exists in the system!");
    }

    // Keep section active
    if(urlParams.get('section')){
        showSection(urlParams.get('section'));
    }
});
