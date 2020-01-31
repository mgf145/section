@php
    $action = Route::currentRouteAction();
    $action = str_replace('@index','',$action);
    $actionClass = str_replace(app()->getNamespace().'Http\Controllers\\','',$action);
    $action = explode('\\',$action);
    $sectionName = $action[3];
    $controllerName = $action[6];
@endphp
@extends('admin.master')
@section('title',trans('admin.name'))
@section('content')
    <div class="row">
        @includeIf('admin.search')
        <div class="col-md-12">
            <div class="card">
                @yield('table_header',View::make('admin.index-table-header',compact([
                    'items',
                    'sectionName',
                    'actionClass',
                    'controllerName'
                ])))
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @yield('table_head',View::make('admin.index-table-head'))
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            @yield('table_body',View::make('admin.index-table-body',compact([
                                'item',
                                'sectionName',
                                'actionClass',
                                'controllerName'
                            ])))
                        @empty
                            <tr>
                                <td colspan="20" class="text-center">@lang('admin.no_data_to_show')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {!! $items->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{action($actionClass.'@destroy',1)}}" id="delete-form">
        @csrf
        @method('delete')
    </form>
@endsection
