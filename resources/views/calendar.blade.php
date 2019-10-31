@extends('app')

@section('content')


<div class="container" style="width: 60%">

    <div class="panel panel-default" style="margin: auto;">
        
        <div class="panel-heading" style="text-align: center;">
            ミトメルカレンダー
    	</div>

        <div class="panel-body" style="display: block;">
        @foreach ($dummyCalendar as $dummyDay)
            <div class="calendar day" ></div>
        @endforeach

        @foreach ($calendar as $day)
        
        <form action="/{{ $day['year'] }}/{{ $day['month'] }}/{{ $day['nowDate'] }}" method="POST">
            @csrf
                <button type="submit" name="day" class="calendar hanamaru-{{$day['hanamaru']}} sunday day" value="{{ $day['nowDate'] }}">{{$day['nowDate']}}</button>
        </form>
        @endforeach
        </div>
    </div>

    <br/>
    <div class="panel panel-default" style="margin: auto;">
        <div class="panel-heading" style="text-align: center;">
        {{ $calendar[1]['month'] }}月{{ $calendar[1]['day'] }}日
    	</div>
        <br/><br/>

		<div style="text-align: center;margin: auto;">
			<button type="submit" class="btn btn-primary" id="modal-open">
				<i class="fa fa-plus" ></i>目標を入力する！
            </button>           
        </div>   

        <div style="text-align: center;margin: auto;">
            <button type="submit" class="btn btn-primary" style="margin-top: 15px;" id="modal-open-update">
				<i class="fa fa-plus" ></i>結果を入力する！
			</button>
        </div>

     <div style="margin-top: 25px;"></div>
    </div>
</div>

<div id="modal-content" style="display:none;">
    <div class="panel panel-default" style="display:flex;">
        <img src="{{ asset('/mito.jpg') }}" class="circle" style="margin: 10px 20px 10px 20px">
        <div class="serif">
        {{ $calendar[1]['month'] }}月{{ $calendar[1]['day'] }}日の目標の入力だね！
        がんばろうね！</div>
    </div>

        <form action="/calendar/regist" method="POST" class="form-horizontal">
			{{ csrf_field() }}

			<div class="form-group">
				<label for="task-name" class="col-sm-3 control-label">Task1</label>

				<div class="col-sm-6">
					<input type="text" name="task1" class="form-control" value="{{ old('task1') }}">
				</div>
            </div>
            
            <div style="margin-top: 45px;"></div>

            <div class="form-group">
				<label for="task-name" class="col-sm-3 control-label">Task2</label>

				<div class="col-sm-6">
					<input type="text" name="task2" class="form-control" value="{{ old('task2') }}">
				</div>
            </div>
            
            <div style="margin-top: 45px;"></div>

            <div class="form-group">
				<label for="task-name" class="col-sm-3 control-label">Task3</label>

				<div class="col-sm-6">
					<input type="text" name="task3" class="form-control" value="{{ old('task3') }}">
				</div>
			</div>


            <input type="hidden" name="year" value="{{ $calendar[1]['year'] }}">
            <input type="hidden" name="month" value="{{ $calendar[1]['month'] }}">
            <input type="hidden" name="day" value="{{ $calendar[1]['day'] }}">

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default">
						<i class="fa fa-plus"></i>目標を決定する
					</button>
				</div>
			</div>
        </form>

        <footer class="modal_footer">
            <button type="submit" class="btn btn-primary" id="modal-close">
            閉じる
            </button>
        </footer>
</div>

<div id="modal-content-update" style="display:none;">

<div class="panel panel-default" style="display:flex;">
        <img src="{{ asset('/mito.jpg') }}" class="circle" style="margin: 10px 20px 10px 20px">
        <div class="serif">
        {{ $calendar[1]['month'] }}月{{ $calendar[1]['day'] }}日の達成度を0~100で入力しよう！
        できたかな？</div>
    </div>

        <form action="/calendar/update" method="POST" class="form-horizontal">
			{{ csrf_field() }}

						<!-- Book Name -->
			<div class="form-group">
				<label for="task-name" class="col-sm-3 control-label">{{ $selectDate['task1']}}</label>

				<div class="col-sm-6">
					<input type="text" name="task1achievement" class="form-control" value="{{ old('task1achievement') }}">
				</div>
            </div>
            
            <div style="margin-top: 45px;"></div>

            <div class="form-group">
				<label for="task-name" class="col-sm-3 control-label">{{ $selectDate['task2']}}</label>

				<div class="col-sm-6">
					<input type="text" name="task2achievement" class="form-control" value="{{ old('task2achievement') }}">
				</div>
            </div>
            
            <div style="margin-top: 45px;"></div>

            <div class="form-group">
				<label for="task-name" class="col-sm-3 control-label">{{ $selectDate['task3']}}</label>

				<div class="col-sm-6">
					<input type="text" name="task3achievement" class="form-control" value="{{ old('task3achievement') }}">
				</div>
			</div>


            <input type="hidden" name="year" value="{{ $calendar[1]['year'] }}">
            <input type="hidden" name="month" value="{{ $calendar[1]['month'] }}">
            <input type="hidden" name="day" value="{{ $calendar[1]['day'] }}">

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default">
						<i class="fa fa-plus"></i>結果を決定する
					</button>
				</div>
			</div>
        </form>

        <footer class="modal_footer">
            <button type="submit" class="btn btn-primary" id="modal-close-update">
            閉じる
            </button>
        </footer>
</div>

@endsection

