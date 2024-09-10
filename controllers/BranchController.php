<?php

namespace Controller;

class BranchController
{
    public function createBranch()
    {
        loadView("dashboard/create-branch", loadFromPublic:  false);
    }
}