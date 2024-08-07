<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('dispatch-channel.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('presence-channel', function ($user) {
   
  return   $user;
});

Broadcast::channel('presence-reunion-channel', function ($user) {
  return   $user;
});

Broadcast::channel('reunion.{reunionId}', function ($user, $reunionId) {
  return $user;
});

