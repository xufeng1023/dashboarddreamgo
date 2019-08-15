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
            <h2 class="mb-3 mt-4">{{ $profile['ms_profile_name'] }} - 申请人基本资料</h2>
            <div class="row">
                <div class="col-12 col-sm-3">
                    <div><span class="text-primary mr-3">学校:</span>{{ $profile['ms_profile_school'] }}</div>
                    <div><span class="text-primary mr-3">GPA:</span>{{ $profile['ms_profile_gpa'] }}</div>
                    <div><span class="text-primary mr-3">标化成绩:</span>{{ $profile['ms_profile_score'] }}</div>
                </div>
                <div class="col-12 col-sm-9">
                    <div><span class="text-primary mr-3">课外活动:</span>{{ $profile['ms_profile_activity'] }}</div>
                    <div><span class="text-primary mr-3">实习科研:</span>{{ $profile['ms_profile_intern'] }}</div>
                    <div><span class="text-primary mr-3">学生需求:</span>{{ $profile['ms_profile_wants'] }}</div>
                </div>
            </div>
            <h2 class="mt-5 mb-3">{{ $profile['ms_profile_name'] }} - Dreamgo推荐选校方案</h2>
        	<table class="table table-striped table-bordered shadow">
        		<thead>
        			<tr>
                        <th></th>
        				<th>学校</th>
                        
    				    <th>
                            @if(!isset($profile['ms_profile_type']) || $profile['ms_profile_type'] != 'high school')
                            <div>专业</div>
                            @endif
                            <div>官网链接</div>
                        </th>
                        
        				<th><div>综合</div>排名</th>
        				<th hidden><div>专业</div>排名</th>
        				<th>城市</th>
        				<th>申请截止日期</th>
        				<th>申请材料</th>
        				<th>其他要求</th>
        				<th>学费</th>
        				<th class="nowrap"><div>申请人</div>优势硬伤分析</th>
        				<th class="nowrap"><div>DIY</div>申请成功率</th>
        				<th class="nowrap"><div>Dreamgo</div>申请成功率</th>
        			</tr>
        		</thead>
        		<tbody>
                    <?php $ranking = 0; ?>
        			<?php foreach($programs as $key => $p) : ?>
                        <?php if($p['vip'] <= 1) continue; ?>
                        <?php if(!isset($majors[$key])) continue; ?>
                        <?php $ranking++; ?>
		            	<tr>
                            <td>{{ $ranking }}</td>
		            		<td>{{ @$majors[$key]['mp_school'] }}</td>
                            <td>
                                @if(!isset($profile['ms_profile_type']) || $profile['ms_profile_type'] != 'high school')
                                    <div>{{ @$majors[$key]['mp_major'] }}</div>
                                @endif
                                <div>
                                    <a style="color: #c6ad63;" href="{{ @$majors[$key]['mp_website'] }}" target="_blank">官网链接</a>
                                </div>
                            </td>
                            <td class="ranking">{{ @$majors[$key]['mp_ranking'] }}</td>
                            <td hidden>{{ @$majors[$key]['mp_major_ranking'] ?? '' }}</td>
                            <?php $location = explode(',', @$majors[$key]['mp_location']); ?>
                            <td class="nowrap">
                                <div>{{ $location[0] }}</div>
                                <div>{{ @$location[1] }}</div>
                            </td>
                            <td>
                                <div>1st: {{ @$majors[$key]['mp_deadline_1'] }}</div>
                                <div>2nd: {{ @$majors[$key]['mp_deadline_2'] }}</div>
                                <div>3rd: {{ @$majors[$key]['mp_deadline_3'] }}</div>
                            </td>
                            <td class="nowrap">
                                @if(@$majors[$key]['mp_recommendation'])
                                    <div>{{ @$majors[$key]['mp_recommendation'] }}份推荐信,</div>
                                @endif
                                @if(@$majors[$key]['mp_personal_statement'])
                                    <div>{{ @$majors[$key]['mp_personal_statement'] }} Personal Statement,</div>
                                @endif
                                @if(@$majors[$key]['mp_resume'] == 'Yes')
                                    <div>Resume,</div>
                                @endif
                                @if(@$majors[$key]['mp_financial_documents'] && @$majors[$key]['mp_financial_documents'] == 'Yes')
                                    <div>Financial Documents,</div>
                                @endif
                                @if(@$majors[$key]['mp_transcripts'] == 'Yes')
                                    <div>Transcripts</div>
                                @endif
                            </td>
                            <?php $other = explode('+', @$majors[$key]['mp_other']); ?>
                            <td>
                                @foreach($other as $o)
                                    <div class="other">{{ $o }}</div>
                                @endforeach
                            </td>
                            <?php $tuition = @str_replace(' ', '', $majors[$key]['mp_tuition']); ?>
                            <?php $tuition = explode('/', $tuition); ?>
                            <td><div>{{ $tuition[0] ?? '' }}</div>{{ $tuition[1] ?? '' }}</td>
                            <td>
                                <div class="mb-1">
                                    <div>GPA</div>
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="fa fa-star {{ $i <= $p['gpa']? 'checked' : '' }}"></span>
                                    @endfor
                                </div>
                                <div class="mb-1">
                                    @if(isset($profile['ms_profile_type']))
                                        @if($profile['ms_profile_type'] == 'undergraduate')
                                            <div>SAT</div>
                                        @endif
                                        @if($profile['ms_profile_type'] == 'high school')
                                            <div>ISEE/SSAT</div>
                                        @endif
                                         @if($profile['ms_profile_type'] == 'master')
                                            <div>GRE/GMAT</div>
                                        @endif
                                    @else
                                        <div>GRE/GMAT</div>
                                    @endif

                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="fa fa-star {{ $i <= $p['gregmat']? 'checked' : '' }}"></span>
                                    @endfor
                                </div>
                                <div class="mb-1">
                                    <div>课外活动</div>
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="fa fa-star {{ $i <= $p['activity']? 'checked' : '' }}"></span>
                                    @endfor
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="badge badge-pill {{ $p['diy'] < 45? 'badge-danger' : ($p['diy'] < 70? 'badge-warning' : 'badge-success') }}">{{ $p['diy'] }}%</div>
                            </td>
                            <td class="text-center">
                                <div class="badge badge-pill {{ $p['vip'] < 45? 'badge-danger' : ($p['vip'] < 70? 'badge-warning' : 'badge-success') }}">{{ $p['vip'] }}%</div>
                            </td>
		            	</tr>
		            <?php endforeach; ?>
        		</tbody>
            </table>
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