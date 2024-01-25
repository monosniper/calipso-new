<div class="freelancer white_block">
    <div href="{{route('chat.conversation', $conversation['id'])}}" class="freelancer-header">
        <div class="freelancer-header-left">
            <div class="freelancer-avatar">
                @online($conversation['companion']->id)
                <span class="user_online"></span>
                @endonline
                <img src="{{$conversation['companion']->getAvatar()}}" alt="{{$conversation['companion']->fullName}}">
            </div>
        </div>
        <div class="freelancer-header-right">
            <div class="freelancer-header-right-left">
                <div class="freelancer-name">{{$conversation['companion']['fullName']}}</div>
                @if($conversation['last_message'])
                    <div class="freelancer-location">{{$conversation['last_message']['created_at_human']}}: {{ $conversation['last_message']['body'] }}</div>
                @endif
            </div>
        </div>
    </a>
</div>
