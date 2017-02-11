@extends('layout')

<div class="jumbotron" style="background-color:transparent;">
    <div class="container">

        <table class="table">
            <thead class="thead-inverse">
                <tr>
                    <th colspan="4">
                        {{$weather->location->city}},
                        {{$weather->location->country}},
                        {{$weather->location->region}} - {{$weather->item->forecast[$day]->day}} {{$weather->item->forecast[$day]->date}}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" colspan="4"><img src="http://l.yimg.com/a/i/us/we/52/{{$weather->item->forecast[$day]->code}}.gif" /> {{$weather->item->forecast[$day]->text}}</th>
                </tr>
                <tr>
                    <td>High: </td>
                    <td>{{$weather->item->forecast[$day]->high}} {{$weather->units->temperature}}</td>
                    <td>Low:</td>
                    <td>{{$weather->item->forecast[$day]->low}} {{$weather->units->temperature}}</td>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: right;">
                        {{$weather->item->title}}
                    </th>
                </tr>
            </tbody>
        </table>
<br>




    </div>
</div>