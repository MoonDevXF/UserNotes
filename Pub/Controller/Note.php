<?php

namespace DEKU\UserNotes\Pub\Controller;

use XF;
use XF\Mvc\ParameterBag;
use XF\Pub\Controller\AbstractController;

class Note extends AbstractController
{
    protected function preDispatchController($action, ParameterBag $params)
    {
        $this->assertRegistrationRequired();

        if (!XF::visitor()->hasPermission('deku_user_notes', 'can_create'))
        {
            throw $this->exception($this->noPermission());
        }
    }


    public function actionIndex()
    {
        $viewParams = [
            'notes' => $this->getUserNote()->note
        ];

        return $this->view('DEKU\UserNotes:UserNotes\Index', 'deku_usernotes_index', $viewParams);

    }

    public function actionSave()
    {
        $this->assertPostOnly();

        $notes = $this->plugin('XF:Editor')->fromInput('notes');
        $note = $this->getUserNote();
        $note->note = $notes;

        $note->save();

        return $this->redirect($this->buildLink('user-notes'));

    }

    private function getUserNote()
    {

        $note = $this->finder('DEKU\UserNotes:Note')->where('user_id', XF::visitor()->user_id)->fetchOne();

        if (!$note)
        {
            $note = $this->em()->create('DEKU\UserNotes:Note');
            $note->user_id = XF::visitor()->user_id;
        }

        return $note;
    }
}