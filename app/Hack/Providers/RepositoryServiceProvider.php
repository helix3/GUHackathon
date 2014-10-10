<?php namespace Hack\Providers;

use CSWM\ChatCount;
use CSWM\ChatMessage;
use CSWM\ChatReply;
use CSWM\ChatRoom;
use CSWM\Favourite;
use CSWM\Repositories\ChatCount\EloquentChatCount;
use CSWM\Repositories\ChatMessage\MongoChatMessage;
use CSWM\Repositories\ChatReply\MongoChatReply;
use CSWM\Repositories\ChatRoom\EloquentChatRoom;
use CSWM\Repositories\Favourite\MongoFavourite;
use CSWM\Repositories\User\EloquentUser;
use CSWM\SasList;
use CSWM\User;
use Hack\Repositories\Sas\EloquentSas;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('Hack\Repositories\Sas\SasInterface', function ($app) {
            return new EloquentSas(new SasList());

        });
    }
}
