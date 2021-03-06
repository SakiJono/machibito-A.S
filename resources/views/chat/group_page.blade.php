<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $group->group_name }}
        </h2>
    </x-slot>
        <section class="home_section_news">
            <h1 class="chath1_red">{{ $group->group_name }}へようこそ！</h1>
            <div class="chat_style">
                <div class="private">
                    <h2>参加メンバー</h2>
                    <div class="chatmember">
                        @foreach ($members as $member)
                        <a href="{{ route('user_profile',$member->id) }}">
                            <div class="select_data">
                                <img src="{{ $member->profile_photo_url }}" alt="" class="chat_img">
                                <p class="username">{{ $member->name }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="private">
                    <h2>チャット</h2>
                    <div>
                        <div  class="output">
                            @foreach ($messages as $message)
                            @if($message->user_id == Auth::id())
                            <div>
                                <div class="right">
                                    <div class="balloon1-right">
                                        <p>{{ $message->message }}</p>
                                    </div>
                                    <img src="{{ $message->profile_photo_url }}" alt="" width="30px" height="30px">
                            </div>
                            </div>
                            @else
                            <div>
                                <div class="left">
                                    <div class="jono">
                                        <img src="{{ $message->profile_photo_url }}" alt="" width="30px" height="30px">
                                        <p>{{ $message->name }}</p>
                                    </div>
                                    <div class="balloon1-left">
                                        <p>{{ $message->message }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <form action="{{ route('message') }}" method="POST">
                            @csrf
                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                            <textarea name="message" id="" cols="30" rows="3" required></textarea>
                            <button type="submit" class="chath1_red">送信</button>
                        </form>
                    </div>
                </div>
            </div>
            <form action="{{ route('groups.destroy',$group->id) }}" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="withdrawal">退会する</button>
            </form>
        </section>
</x-app-layout>
