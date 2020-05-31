{{--{{dd($realizationBids)}}--}}
<table>
    <thead>
    <tr>
        <th class=""  colspan="5"  style="font-size: 12px; background-color: #66cbcc;"><b>Статистика вакансий по специальностям</b></th>
    </tr>
    <tr>
        <th align="right"  colspan="5"  style="font-size: 12px; background-color: #66cbcc;"><b>{{$statistics['date']}}</b></th>
    </tr>
    <tr>
        <th style="font-size: 12px; background-color: #0097DE;" colspan="3" class="b"><b>Специальность</b></th>
        <th style="font-size: 12px; background-color: #00A4EC;" colspan="2" class=""><b>Вакансии</b></th>
    </tr>
    </thead>
    <tbody>
    @php
        $changeColor=true;
    @endphp
    @foreach($statistics as $statistic)
        @if($statistic->name??'')
            <tr>
                <td align="right" style="background-color: {{$changeColor?'#09DEDA':'#0097DE'}};" colspan="3">{{$statistic->name??''}}</td>
                <td valign="middle" style="background-color: {{$changeColor?'#09E6E2':'#00A4EC'}};" colspan="2">{{ $statistic->total??''}}</td>
            </tr>
            @php($changeColor=!$changeColor)
        @endif
    @endforeach
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th colspan="5"  style="font-size: 12px; background-color: #66cbcc;"><b>Статистика резюме по специальностям</b></th>
    </tr>
    <tr>
        <th align="right"  colspan="5"  style="font-size: 12px; background-color: #66cbcc;"><b>{{$statisticsResumes['date']}}</b></th>
    </tr>
    <tr>
        <th style="font-size: 12px; background-color: #0097DE;" colspan="3"><b>Специальность</b></th>
        <th style="font-size: 12px; background-color: #00A4EC;" colspan="2"><b>Резюме</b></th>
    </tr>
    </thead>
    <tbody>
    @php($changeColor=true)
    @foreach($statisticsResumes as $statistic)
        @if($statistic->name??'')
            <tr>
                <td align="right" style="background-color: {{$changeColor?'#09DEDA':'#0097DE'}};" colspan="3">{{$statistic->name??''}}</td>
                <td valign="middle" style="background-color: {{$changeColor?'#09E6E2':'#00A4EC'}};" colspan="2">{{ $statistic->total??''}}</td>
            </tr>
            @php($changeColor=!$changeColor)
        @endif
    @endforeach
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th colspan="5"  style="font-size: 12px; background-color: #66cbcc;"><b>Реализация вакансий по специальности</b></th>
    </tr>
    <tr>
        {{--<th align="right"  colspan="5"  style="font-size: 12px; background-color: #66cbcc;"><b>{{$realizationBids['date']}}</b></th>--}}
    </tr>
    <tr>
        <th style="font-size: 12px; background-color: #0097DE;" colspan="3"><b>Специальность</b></th>
        <th style="font-size: 12px; background-color: #00A4EC;" colspan="2"><b>Опубликовано</b></th>
        <th style="font-size: 12px; background-color: #00A4EC;" colspan="2"><b>Реализовано</b></th>
        <th style="font-size: 12px; background-color: #00A4EC;" colspan="2"><b>Спрос</b></th>
    </tr>
    </thead>
    <tbody>
    @php($changeColor=true)
    @foreach($realizationBids as $statistic)
        @if($statistic['specialty']??'')
            <tr>
                <td style="background-color: {{$changeColor?'#09DEDA':'#0097DE'}};" colspan="3">{{ $statistic['specialty']??''}}</td>
                <td style="background-color: {{$changeColor?'#09E6E2':'#00A4EC'}};" colspan="2">{{ $statistic['cancel']??''}}</td>
                <td style="background-color: {{$changeColor?'#09E6E2':'#00A4EC'}};" colspan="2">{{ $statistic['success']??''}}</td>
                <td style="background-color: {{$changeColor?'#09E6E2':'#00A4EC'}};" colspan="2">{{ $statistic['cancel']/($statistic['success']??1)*100}}</td>
            </tr>
            @php($changeColor=!$changeColor)
        @endif
    @endforeach
    </tbody>
</table>
