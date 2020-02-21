<?php
interface iC3PO {
    public function __construct($nom, $type = "droide de protocole");
    public function __toString();
    public function dire($str);
    public function marcher();
    public function initierProtocole();
}