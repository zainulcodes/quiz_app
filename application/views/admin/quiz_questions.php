<div class="card">
<div class="card-header">
<button class="btn btn-primary" id="addBtn">Tambah Soal</button>
</div>

<div class="card-body">
<table id="table" class="table table-bordered"></table>
</div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modal">
<div class="modal-dialog">
<div class="modal-content p-3">

<input type="hidden" id="id">

<textarea id="question" class="form-control mb-2" placeholder="Soal"></textarea>

<input type="text" id="a" class="form-control mb-2" placeholder="Option A">
<input type="text" id="b" class="form-control mb-2" placeholder="Option B">
<input type="text" id="c" class="form-control mb-2" placeholder="Option C">
<input type="text" id="d" class="form-control mb-2" placeholder="Option D">

<select id="correct" class="form-control mb-2">
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
</select>

<button id="saveBtn" class="btn btn-success">Simpan</button>

</div>
</div>
</div>
<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/adminlte.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/dataTables.bootstrap4.min.css'); ?>">

<script src="<?php echo base_url('assets/admin/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/bootstrap.bundle.min.js'); ?>"></script>
<script>
var table;

$(function(){

table = $("#table").DataTable({
    ajax: "<?= base_url('admin/get_quiz_questions') ?>",
    columns: [
        {data:"id", title:"ID"},
        {data:"question", title:"Soal"},
        {data:"correct_answer", title:"Jawaban"},
        {
            data:null,
            render:function(d){
                return `
                <button class="btn btn-warning btn-sm edit" data-id="${d.id}">Edit</button>
                <button class="btn btn-danger btn-sm delete" data-id="${d.id}">Hapus</button>
                `;
            }
        }
    ]
});

});

/* ADD */
$("#addBtn").click(function(){
    $("#modal").modal('show');
    $("input, textarea").val("");
});

/* SAVE */
$("#saveBtn").click(function(){

    var id = $("#id").val();
    var url = id ? "update_quiz_question" : "save_quiz_question";

    $.post("<?= base_url('admin/') ?>" + url,{
        id:id,
        question:$("#question").val(),
        a:$("#a").val(),
        b:$("#b").val(),
        c:$("#c").val(),
        d:$("#d").val(),
        correct:$("#correct").val()
    },function(){
        $("#modal").modal('hide');
        table.ajax.reload();
    });

});

/* EDIT */
$(document).on("click",".edit",function(){

    var id = $(this).data("id");

    $.get("<?= base_url('admin/get_quiz_question/') ?>" + id,function(r){

        $("#modal").modal('show');

        $("#id").val(r.id);
        $("#question").val(r.question);
        $("#a").val(r.option_a);
        $("#b").val(r.option_b);
        $("#c").val(r.option_c);
        $("#d").val(r.option_d);
        $("#correct").val(r.correct_answer);

    },'json');

});

/* DELETE */
$(document).on("click",".delete",function(){

    if(confirm("Hapus soal?")){
        var id = $(this).data("id");

        $.get("<?= base_url('admin/delete_quiz_question/') ?>" + id,function(){
            table.ajax.reload();
        });
    }

});
</script>