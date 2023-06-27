@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-0" >
                <users-list></users-list>
            </div>
            <div class="col-9 p-0">
                <div class="card">
                    <div class="card-header">Chats</div>
                    <div class="card-body position-relative" style="overflow-y: auto;
    height: 400px;">
                        <chat-messages :messages="messages" :user="{{ Auth::id() }}"></chat-messages>
                    </div>
                    <div class="card-footer">
                        <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
