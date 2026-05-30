<?php

class GuestbookController extends PageController 
{
    public function action_main(): void 
    {
        $this->action_index(); 
    }

    public function action_index(): void 
    {
        $this->render('guestbook/index', [
        ], 'Відгуки про GymMaster');
    }
}