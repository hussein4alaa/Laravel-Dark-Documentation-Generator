<div class="card">


    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <div class="btn-group" role="group" aria-label="Basic example">
                <div class="btn btn-link
                {{ $route['method'] == 'GET' ? 'get-bar' : '' }}
                {{ $route['method'] == 'POST' ? 'post-bar' : '' }}
                {{ $route['method'] == 'PUT' ? 'put-bar' : '' }}
                {{ $route['method'] == 'DELETE' ? 'delete-bar' : '' }}
                "
                    data-toggle="collapse" data-target="#{{ $route['index'] }}" aria-expanded="true"
                    :aria-controls="{{ $route['index'] }}">
                    <button
                        class="btn btn-method
                    {{ $route['method'] == 'GET' ? 'get-button' : '' }}
                    {{ $route['method'] == 'POST' ? 'post-button' : '' }}
                    {{ $route['method'] == 'PUT' ? 'put-button' : '' }}
                    {{ $route['method'] == 'DELETE' ? 'delete-button' : '' }}
                    ">
                        {{ $route['method'] }}
                    </button>
                    <b class="url-head">{{ $route['short_url'] }}</b>
                    <b class="function-name"
                        style="color: #bebebe; padding-left: 1pc; font-weight: 400;">{{ $route['function'] }}</b>
                </div>

                @if ($route['auth'] == true)
                    <button type="button"
                        class="
                    btn auth-btn
                    {{ $route['method'] == 'GET' ? 'get-bar' : '' }}
                    {{ $route['method'] == 'POST' ? 'post-bar' : '' }}
                    {{ $route['method'] == 'PUT' ? 'put-bar' : '' }}
                    {{ $route['method'] == 'DELETE' ? 'delete-bar' : '' }}

                    "
                        data-toggle="modal" data-target="#exampleModal">
                        <img src="https://icons555.com/images/icons-gray/image_icon_lock_pic_512x512.png"
                            class="lock" />
                    </button>
                @endif

            </div>
        </h5>
    </div>

    <div id="{{ $route['index'] }}"
        class="collapse
    {{ $key == 0 ? 'show' : '' }}
    {{ $route['method'] == 'GET' ? 'get-bar' : '' }}
    {{ $route['method'] == 'POST' ? 'post-bar' : '' }}
    {{ $route['method'] == 'PUT' ? 'put-bar' : '' }}
    {{ $route['method'] == 'DELETE' ? 'delete-bar' : '' }}
    "
        aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
            <form id="id_{{ $route['index'] }}"
                onsubmit="checkAuth('{{ $route['url'] }}', '{{ $route['method'] }}', '{{ $route['index'] }}', '{{ $route['auth'] }}');return false">
                @if (count($route['params']) !== 0)
                    <div>
                        <div class="card-header">Parameters</div>
                        <div class="padding">
                            <table class="params-table">
                                <tr class="params-tr">
                                    <td class="params-td">Name</td>
                                    <td class="params-td">Description</td>
                                    <td class="params-td">Input</td>
                                </tr>

                                @foreach ($route['params'] as $param)
                                    <tr class="params-tr">
                                        <td class="params-body-td">{{ $param }} <span
                                                class="required">*</span>
                                        </td>
                                        <td class="params-body-td">
                                            <span class="required">Required</span>
                                        </td>
                                        <td class="params-body-td">
                                            <input class="form-control" type="text" placeholder="{{ $param }}"
                                                name="{{ $param }}" required autocomplete="false" />
                                        </td>
                                    </tr>
                                @endforeach


                            </table>
                        </div>
                        <br />
                    </div>
                @endif

                @if (count($route['body']) !== 0)

                    <div>

                        @if ($route['method'] == 'GET' or $route['method'] == 'DELETE')
                            <div class="card-header">
                                Query Params
                            </div>
                        @else
                            <div class="card-header">Body</div>
                        @endif


                        <div class="padding">
                            <table class="params-table">
                                <tr class="params-tr">
                                    <td class="params-td">Name</td>
                                    <td class="params-td">Description</td>
                                    <td class="params-td">Input</td>
                                </tr>

                                @foreach ($route['body'] as $input)
                                    <tr class="params-tr">
                                        <td class="params-body-td">{{ $input['key'] }}</td>
                                        <td class="params-body-td">
                                            @if ($input['required'] == true)
                                                <span class="required">Required</span>
                                            @else
                                                <span class="nullable">nullable</span>
                                            @endif
                                            <span class="nullable"> | {{ $input['label-type'] }}</span>
                                        </td>
                                        <td class="params-body-td">
                                            @if ($input['type'] == 'longtext')
                                            <textarea
                                            name="{{ $input['key'] }}"
                                            cols="30"
                                            placeholder="{{ $input['key'] }}"
                                            class="form-control"
                                            {{ $input['required'] ? 'required' : '' }}
                                            ></textarea>
                                            @else
                                            <input class="form-control" type="{{ $input['type'] }}" name="{{ $input['key'] }}"
                                            placeholder="{{ $input['key'] }}"
                                            {{ $input['required'] ? 'required' : '' }}
                                            />
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                @endif

                <div class="padding">
                    <div class="full-url-content" id="fullurl_{{ $route['index'] }}">
                    </div>

                    <div class="request-response">
                        <div id="response_{{ $route['index'] }}"></div>
                    </div>
                    <div class="request-status">
                        <b id="status_{{ $route['index'] }}" class="status"></b>
                    </div>

                    <div id="tokenmessage_{{ $route['index'] }}"></div>


                    <button
                        class="btn btn-method execute
                    {{ $route['method'] == 'GET' ? 'get-button' : '' }}
                    {{ $route['method'] == 'POST' ? 'post-button' : '' }}
                    {{ $route['method'] == 'PUT' ? 'put-button' : '' }}
                    {{ $route['method'] == 'DELETE' ? 'delete-button' : '' }}
                    ">
                        Execute
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

