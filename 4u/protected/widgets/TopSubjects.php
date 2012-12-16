<?php

class TopSubjects extends CWidget {

    private $viewData;
    private $SubjectModel;

    public function init() {

        /* @var $SubjectModel SubjectModel */
       $this->SubjectModel = new SubjectModel();
    }

    public function run() {
        $this->viewData['subjects'] = $this->SubjectModel->get_top_subjects();
        $this->render('top_subjects',$this->viewData);
    }

}