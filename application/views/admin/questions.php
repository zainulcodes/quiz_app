<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/adminlte.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/dataTables.bootstrap4.min.css'); ?>">

<script src="<?php echo base_url('assets/admin/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/bootstrap.bundle.min.js'); ?>"></script>
</head>

<body class="p-4">

<button class="btn btn-primary mb-2" id="add">Tambah</button>

<table id="tbl" class="table table-bordered"></table>

<div class="modal fade" id="modal">
<div class="modal-dialog">
<div class="modal-content p-3">
<input type="hidden" id="id">
<textarea id="question" class="form-control mb-2" placeholder="Soal"></textarea>
<input id="option_a" class="form-control mb-2" placeholder="A">
<input id="option_b" class="form-control mb-2" placeholder="B">
<input id="option_c" class="form-control mb-2" placeholder="C">
<input id="option_d" class="form-control mb-2" placeholder="D">
<input id="correct_answer" class="form-control mb-2" placeholder="Jawaban benar (A/B/C/D)">
<button id="save" class="btn btn-success">Simpan</button>
</div>
</div>
</div>

<script>
var t;
$(function(){
 t=$("#tbl").DataTable({
  ajax:"<?= base_url('admin/get_questions')?>",
  columns:[
   {data:"id",title:"ID"},
   {data:"question",title:"Soal"},
   {data:null,render:d=>`
     <button class='edit btn btn-warning btn-sm' data-id='${d.id}'>Edit</button>
     <button class='del btn btn-danger btn-sm' data-id='${d.id}'>Hapus</button>`}
  ]
 });
});

$("#add").click(()=>{ $("#modal").modal('show'); $("input,textarea").val(""); });

$("#save").click(()=>{
 let id=$("#id").val();
 let url=id?'update_question':'save_question';
 $.post("<?= base_url('admin/') ?>"+url,{
  id:id,
  question:$("#question").val(),
  option_a:$("#option_a").val(),
  option_b:$("#option_b").val(),
  option_c:$("#option_c").val(),
  option_d:$("#option_d").val(),
  correct_answer:$("#correct_answer").val()
 },()=>{ $("#modal").modal('hide'); t.ajax.reload(); });
});

$(document).on("click",".edit",function(){
 let id=$(this).data('id');
 $.get("<?= base_url('admin/get_question/') ?>"+id,function(r){
  $("#modal").modal('show');
  $("#id").val(r.id);
  $("#question").val(r.question);
  $("#option_a").val(r.option_a);
  $("#option_b").val(r.option_b);
  $("#option_c").val(r.option_c);
  $("#option_d").val(r.option_d);
  $("#correct_answer").val(r.correct_answer);
 },"json");
});

$(document).on("click",".del",function(){
 if(confirm("Hapus?")){
  $.get("<?= base_url('admin/delete_question/') ?>"+$(this).data('id'),()=>t.ajax.reload());
 }
});
</script>

</body>
</html>