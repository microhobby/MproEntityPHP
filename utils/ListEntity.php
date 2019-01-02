<?php

class ListEntity implements Iterator
{
          private $lista_ = array();
          private $tam = 0;
          private $position = 0;

          // add item
          public function add($str)
          {
                    $this->lista_[] = $str;
                    $this->tam++;
          }

          // remove item
          public function rem($int)
          {
                    $tmp = $this->lista_[$int];
                    //unset($this->lista_[$int]);
                    array_splice($this->lista_, $int, 1);
                    $this->tam--;
                    return $tmp;
          }

          /**
           * return last item added
           */
          public function pop()
          {
                    $tmp = $this->lista_[$this->tam-1];
                    array_splice($this->lista_, $this->tam-1, 1);
                    $this->tam--;
                    return $tmp;
          }

          /**
           * return the first item added
           */
          public function top()
          {
                    $tmp = $this->lista_[0];
                    array_splice($this->lista_, 0, 1);
                    $this->tam--;
                    return $tmp;
          }

          /**
           * clean list
           */
          public function removeAll()
          {
                    $this->lista_ = null;
                    $this->lista_ = array();
          }

          // get item from index
          public function get($int)
          {
                    return $this->lista_[$int];
          }

          // count items from list
          public function getTam()
          {
                    return $this->tam;
          }

          /**
           * Copy items for another ListEntity
           * @param ListEntity $lista
           */
          public function copy($lista)
          {
                    // clean
                    $this->removeAll();
                    // realocate
                    for($i = 0; $i < $lista->getTam(); $i++)
                              $this->add($lista->get($i));
                    // recalc count
                    $this->tam = $lista->getTam();
          }

          /**
           * Copy only the items are not equals
           * @param Lista $lista
           */
          public function copyNotAmbigous($lista)
          {
                    // clean
                    $this->removeAll();
                    $isOk = true;
                    // realocate
                    for($i = 0; $i < $lista->getTam(); $i++)
                    {
                              for($j = 0; $j < count($this->lista_); $j++)
                              {
                                        if($lista->get($i) == $this->lista_[$j])
                                        {
                                                  $isOk = false;
                                        }
                              }
                              if($isOk)
                              {
                                        $this->add($lista->get($i));
                              }
                              $isOk = true;
                    }
                    // recalc count
                    $this->tam = $lista->getTam();
          }

          /**
           * Concat the this items with the items from the arg
           * @param Lista $lista
           */
          public function append($lista)
          {
                    for($i = 0; $i < $lista->getTam(); $i++)
                              $this->add($lista->get($i));

                    $this->tam = count($this->lista_);
	  }
	  
          public function reverse()
          {
                    $lista_aux = array();

                    for($i = count($this->lista_)-1; $i >= 0; $i--)
                    {
                              $lista_aux[] = $this->lista_[$i];
                    }

                    $this->lista_ = $lista_aux;
          }

          public function toString()
          {
                    $str = "";

                    for($i = 0; $i < count($this->lista_); $i++)
                    {
                              $str .= $this->lista_[$i]." ";
                    }

                    return $str;
          }

          /**
           * Convert toString ListEntity for a ListEntity object
           * @param string $string
           */
          public static function toLista($string)
          {
                    $listAux = new Lista();
                    $frase = $string;
                    $aux = "";

                    for($i = 0; $i < strlen($frase); $i++)
                    {
                              if(($frase[$i] != ",") && ($frase[$i] != " "))
                              {
                                        $aux .= $frase[$i];
                              }
                              else
                              {
                                        if($frase[$i] == " ")
                                        {
                                                  $listAux->add($aux);
                                                  $aux = "";
                                        }
                              }
                    }
                    $listAux->add($aux);

                    return $listAux;
          }

          public function current() 
          {
                    return $this->lista_[$this->position];
          }

          public function key() 
          {
                    return $this->position;
          }

          public function next() 
          {
                    ++$this->position;
          }

          public function rewind() 
          {
                    $this->position = 0;
          }

          public function valid() 
          {
                    return isset($this->lista_[$this->position]);
          }
}

?>
