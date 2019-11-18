@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
div.other{
    max-width: 17rem;
}
.nowrap{
    white-space: nowrap;
}
.fa.fa-star.checked{
    color: #ffc10a;
}
.table td, .table th{
    font-size: 13px;
    text-align: left;
    vertical-align: middle !important;
}
.badge-pill{
    width: 50px;
    height: 50px;
    font-size: 13px !important;
    display: inline-flex !important;
    justify-content: center;
    align-items: center;
}
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col">
           
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // $(function() {
    //     $('tbody tr').sort(function(a, b) {
    //         console.log(Number($(a).find('td.ranking').text()) , Number($(b).find('td.ranking').text()))
    //         return Number($(a).find('td.ranking').text()) - Number($(b).find('td.ranking').text());
    //     })
    // });
</script>
@endsection