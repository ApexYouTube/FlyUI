<?php

declare(strict_types= 1);

namespace FlyUI;

use pocketmine\Player;
use pocketmine\level\sound\GenericSound;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\Level;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
/*use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;*/

class main extends PluginBase implements Listener {
  
  public function onEnable(){
    
  }
  
  public function onDisable(){
    
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
  
    switch($cmd->getName()){
      case "fly":
      if($sender instanceof Player){
      if($sender->hasPermission("flyui.use")){
          $this->openMyForm($sender);
      } else {
          $sender->sendMessage("§cYou need to buy a higher rank in order to use this.");
          }
        }
      }
  return true;
  }
      
  public function openMyForm($player){
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createSimpleForm(function (Player $player, int $data = null){
        $result = $data;
        if($result === null){
            return true;
        }
        switch($result){
          case 0:
                $player->setAllowFlight(true);
                $player->sendMessage("§aFly Mode Has Been Enabled!");
          break;
            
          case 1:
                $player->setAllowFlight(false);
                $player->sendMessage("§cFly Mode Has Been Disabled!");
          break;

          break;
        }
    });
    $form->setTitle("§6Blitz§ePvP");
    $form->setContent("§aTo Enable Fly§7/§cTo Disable Fly");
    $form->addButton("§aEnable Fly");
    $form->addButton("§cDisable Fly");
    $form->addButton("§cCancel");
    $form->sendToPlayer($player);
    return $form;
    }
}