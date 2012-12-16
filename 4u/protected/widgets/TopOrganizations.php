<?php

class TopOrganizations extends CWidget {

    private $viewData;
    private $OrganizationModel;

    public function init() {

        /* @var $OrganizationModel OrganizationModel */
       $this->OrganizationModel = new OrganizationModel();
    }

    public function run() {
        $this->viewData['organizations'] = $this->OrganizationModel->get_top_organizations();
        $this->render('top_organizations',$this->viewData);
    }

}