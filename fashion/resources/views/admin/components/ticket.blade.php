<div class="panel panel-default">
    <h3>{{$message->title}}</h3>
    <div class="panel-heading">
        @if(($message->sender)){{$message->sender->firstname}} {{$message->sender->lastname}}@endif 
        <small class="text-muted"> {{$message->date}}</small>
    </div>
    <div class="panel-wrapper collapse in">
        <div class="panel-body">
            <p>{{$message->message}}</p>
        </div>
    </div>
</div>