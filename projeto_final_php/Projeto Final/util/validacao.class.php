<?php
class Validacao{
  public static function validarNome($v){
      $exp = "/^[a-zA-Zà-úÀ-Ú ]{2,50}$/";
      return preg_match($exp,$v);
  }
  public static function validarNomeProduto($v){
      $exp = "/^[a-zA-ZÀ-ú0-9 -+.&:]{2,75}$/";
      return preg_match($exp,$v);
  }
  public static function validarTel($v){
      $exp="/^[0-9 -()+]{8,20}$/";
      return preg_match($exp,$v);
  }
  public static function validarCel($v){
      $exp="/^[0-9 -()+]{9,20}$/";
      return preg_match($exp,$v);
  }
  public static function validarSexo($v){
      $exp="/^(masculino||feminino)$/";
      return preg_match($exp,$v);
  }

  public static function validarSec($v){
      $exp="/^(Alimentos||Limpeza||Bazar||Higiene e Beleza||Outros)$/";
      return preg_match($exp,$v);
  }

  public static function validarTipoUsuario($v){
      $exp="/^(Administrativo||Funcionário||Visitante)$/";
      return preg_match($exp,$v);
  }

  public static function validarPreco($v){
      $exp="/^[0-9.,]{1,20}$/";
      return preg_match($exp,$v);
  }
  public static function validarQtd($v){
      $exp="/^[0-9.]{1,5}$/";
      return preg_match($exp,$v);
  }

}
