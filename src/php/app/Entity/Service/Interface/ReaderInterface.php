<?php

namespace IWA_FormBuilder\Entity\Service\Interface;

interface ReaderInterface
{
    public function setForm(?\IWA_FormBuilder\Form\Form $form): void;

    public function getForm(): ?\IWA_FormBuilder\Form\Form;

    public function getEntityName(): string;

    public function getEntityAttributes(): array;

    public function getEntityChildren(): array;
}
