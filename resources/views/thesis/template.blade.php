@if(count($thesis) > 0)
    <div id="grid-layout-table-1" class="box jplist">
        <div class="jplist-ios-button"><i class="fa fa-sort"></i>jPList Actions</div>
        <div class="jplist-panel box panel-top">
            <button type="button" data-control-type="reset" data-control-name="reset" data-control-action="reset" class="jplist-reset-btn btn btn-default">Reset<i class="fa fa-share mls"></i></button>
            <div data-control-type="drop-down" data-control-name="paging" data-control-action="paging" class="jplist-drop-down form-control">
                <ul class="dropdown-menu">
                    <li><span data-number="3"> 3 per page</span></li>
                    <li><span data-number="5"> 5 per page</span></li>
                    <li><span data-number="10" data-default="true"> 10 per page</span></li>
                    <li><span data-number="all"> view all</span></li>
                </ul>
            </div>
            <div data-control-type="drop-down" data-control-name="sort" data-control-action="sort" data-datetime-format="{month}/{day}/{year}" class="jplist-drop-down form-control">
                <ul class="dropdown-menu">
                    <li><span data-path="default">Sort by</span></li>
                    <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                    <li><span data-path=".title" data-order="desc" data-type="text" data-default="true">Title Z-A</span></li>
                    <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span></li>
                    <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span></li>
                    <li><span data-path=".date" data-order="asc" data-type="datetime">Date asc</span></li>
                    <li><span data-path=".date" data-order="desc" data-type="datetime">Date desc</span></li>
                </ul>
            </div>
            <div class="text-filter-box">
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input data-path=".title" type="text" value="" placeholder="Filter by Title" data-control-type="textbox" data-control-name="title-filter" data-control-action="filter" class="form-control"/></div>
            </div>
            <div class="text-filter-box">
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input data-path=".desc" type="text" value="" placeholder="Filter by Description" data-control-type="textbox" data-control-name="desc-filter" data-control-action="filter" class="form-control"/></div>
            </div>
            <div data-type="Page {current} of {pages}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging" class="jplist-label btn btn-default"></div>
            <div data-control-type="pagination" data-control-name="paging" data-control-action="paging" class="jplist-pagination"></div>
        </div>
        <div class="box text-shadow">
            <table class="demo-tbl">
                @php
                    $labels = ['yellow', 'orange', 'blue', 'green', 'red', 'violet', 'pink', 'grey', 'default']
                @endphp
                @foreach($thesis as $key => $value)
                    <tr class="tbl-item">
                        <td class="td-block"><p class="date">{{ $value->created_at->toFormattedDateString() }}</p>
                            <p class="title" style="text-transform: capitalize; font-size: 20px"><a href="{{ route("thesis.show", $value->id) }}" style="color: #2a6496;">{{ $value->name }}</a></p>
                            <p class="text-uppercase">
                                <span class="label label-{{$labels[rand(0,8)]}}"><a style="color: white" href="{{ route("searchTag", $value->tag_id) }}">{{ $value->tag->name }}</a></span>
                                <span class="label label-{{$labels[rand(0,8)]}}"><a style="color: white" href="{{ route("searchLevel", $value->level_id) }}">{{ $value->level->name }}</a></span>
                                <span class="label label-{{$labels[rand(0,8)]}}"><a style="color: white" href="{{ route("searchSession", explode("/", $value->session)[0]."-".explode("/", $value->session)[1]) }}">{{ $value->session }}</a></span>
                            </p>
                            <p class="desc text-dark">{{ substr($value->abstract, 0,500) }}<a class="block text-danger" href="{{ route("thesis.show", $value->id) }}"> ...read more</a></p>
                            <p class="like">by <strong>{{ $value->authors }}</strong></p></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box jplist-no-results text-shadow align-center"><p>No results found</p></div>
        <div class="jplist-ios-button"><i class="fa fa-sort"></i>jPList Actions</div>
        <div class="jplist-panel box panel-bottom">
            <div data-control-type="drop-down" data-control-name="paging" data-control-action="paging" data-control-animate-to-top="true" class="jplist-drop-down form-control">
                <ul class="dropdown-menu">
                    <li><span data-number="3"> 3 per page</span></li>
                    <li><span data-number="5"> 5 per page</span></li>
                    <li><span data-number="10" data-default="true"> 10 per page</span></li>
                    <li><span data-number="all"> view all</span></li>
                </ul>
            </div>
            <div data-control-type="drop-down" data-control-name="sort" data-control-action="sort" data-control-animate-to-top="true" data-datetime-format="{month}/{day}/{year}" class="jplist-drop-down form-control">
                <ul class="dropdown-menu">
                    <li><span data-path="default">Sort by</span></li>
                    <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                    <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                    <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span></li>
                    <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span></li>
                    <li><span data-path=".like" data-order="asc" data-type="number" data-default="true">Likes asc</span></li>
                    <li><span data-path=".like" data-order="desc" data-type="number">Likes desc</span></li>
                    <li><span data-path=".date" data-order="asc" data-type="datetime">Date asc</span></li>
                    <li><span data-path=".date" data-order="desc" data-type="datetime">Date desc</span></li>
                </ul>
            </div>
            <div data-type="{start} - {end} of {all}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging" class="jplist-label btn btn-default"></div>
            <div data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-control-animate-to-top="true" class="jplist-pagination"></div>
        </div>
    </div>
@else
    <div class="box">
        <p>No project found.</p>
    </div>
@endif