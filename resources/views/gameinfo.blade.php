@extends('layouts.app')


@section('content')

    <div class="content container main-content">
        <div class="columns">
            <div class="column is-two-thirds">
                <h1 id="info-game" class="is-1">The game</h1>
                <p>
                    Ok {{ \Auth::user()->getHouseSingular() }}, this is it! Have you read <a href="{{route('story')}}">the story</a> yet? If you did, you know what's at stake here... <br> And now you want to know how to earn those points do you? Of course you do. The fate of the {{ \Auth::user()->houseRole->house->name }} is in your hands. You can earn points and badges. both of them contribute to your personal growth as to your house. <strong>The only way the {{ \Auth::user()->houseRole->house->name  }} can win is through you participating for your house!</strong>
                </p>

                <h2 class="is-2" id="info-points">Points</h2>
                <p>You can earn points through a variety of activities. Make the most out of all activities and battle to become the highest ranked {{\Auth::user()->getHouseSingular() }}! Some points are allocated through your headmaster, some will be granted directly through the use of the forum, some will be granted by accomplishments throughout your stay in The Coding Kingdom of Null, aka the course 'Applicatie- en mediaontwikkeling' </p>
                <div class="box">
                <h3 class="is-3" id="info-forum">Forum activity</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Description</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($score_types as $type)
                                <tr>
                                    <td><b>{{$type->name}}</b></td>
                                    <td>{{$type->description}}</td>
                                    <td>{{$type->points}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h3 class="is-3" id="info-course">Course activity</h3>
                <p>At the end of every period (The coding Kingdom of Null has 12 periods), points will be awarded to every soldier in The Kingdom. These points will be based on the results during your stay at The Kingdom.</p>
                <div class="box">
                <h5 class="is-5" id="info-general"><u>General Attitude</u></h5>
                <table>
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Gradation</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Attitude during PGO/VHT</b></td>
                            <td>voldoende</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>goed</td>
                            <td>50</td>
                        </tr>
                        <tr>
                            <td><b>Contributions to projects</b></td>
                            <td>voldoende</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>goed</td>
                            <td>50</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="box">
                <h5 class="is-5" id="info-attendance"><u>Attendance</u></h5>
                <table>
                    <thead>
                        <tr>
                            <th>percentage</th>
                            <th>points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> >= 90% </td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td> 100% </td>
                            <td>50</td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <div class="box">
                <h5 class="is-5" id="info-grades"><u>Grades</u></h5>
                <table>
                    <thead>
                        <tr>
                            <th>Grade</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>55</td>
                            <td>15</td>
                        </tr>
                        <tr>
                            <td>60</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>65</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>70</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>75</td>
                            <td>35</td>
                        </tr>
                        <tr>
                            <td>80</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td>85</td>
                            <td>45</td>
                        </tr>
                        <tr>
                            <td>90</td>
                            <td>50</td>
                        </tr>
                        <tr>
                            <td>100</td>
                            <td>75</td>
                        </tr>
                    </tbody>
                    <tbody>


                    </tbody>
                </table>
                </div>

                <h2 class="is-2" id="info-badges">Badges</h2>
                <p>And then there are badges... Wear them proud because these badges are true pieces of honor. See the list below for all the badges you can earn during the 'Coding Conflict'. </p>
                <h4 class="is-4">Badge Collection</h4>
                <div class="box">
                @foreach($badges as $badge)
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-32x32">
                                <img src="{{asset('img/badges')}}/{{$badge->img_path}}" alt="">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <h5 class="badge-title"><strong>{{  $badge->title }}</strong></h5>
                                <p class="badge-description"> {{ $badge->description }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
                </div>
            </div>

            <div class="column is-one-third">
                <div class="box" style="position:fixed">
                    <h4 class="is-4">Overview</h4>
                    <ul>
                        <li><a href="#info-game">The game</a></li>
                        <li>
                            <a href="#info-points">Points</a>
                            <ul>
                                <li><a href="#info-forum">Forum activity</a></li>
                                <li>
                                    <a href="#info-course">Course activity</a>
                                    <ul>
                                        <li><a href="#info-general">General Attitude</a></li>
                                        <li><a href="#info-attendance">Attendance</a></li>
                                        <li><a href="#info-grades">Grades</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#info-badges">Badges</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

@endsection
