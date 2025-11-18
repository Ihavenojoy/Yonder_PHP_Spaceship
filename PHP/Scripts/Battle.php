<?php

namespace Scripts;

use Entities\Fleet;

class Battle
{
    public array $Fleets;
    protected array $Log;

    public function __construct()
    {
        $this->Fleets = [];
        $this->Log = [];
    }

    public function AddFleet(Fleet $fleet) : void
    {
        $this->Fleets[] = $fleet;
    }

    public function Start(): void
    {
        if (count($this->Fleets) >= 2) {
            $this->BattleLoop();
        } else {
            echo "Kan de strijd niet starten. Er zijn minstens 2 vloten nodig.";
        }
    }

    public function BattleDone(): bool
    {
        $survivor_count = 0;
        foreach ($this->Fleets as $fleet) {
            if ($fleet->getShips() > 0) {
                $survivor_count++;
                if ($survivor_count > 1) return false;
            }
        }
        return true;
    }

    public function BattleLoop()
    {
        $roundsWithoutDamage = 0;
        $maxRoundsWithoutDamage = 200;
        while (!$this->BattleDone()) {
            $active_fleets = array_values(array_filter($this->Fleets, function($f) {
                return $f->getShips() > 0;
            }));

            if (count($active_fleets) < 2) break;

            $damageThisRound = 0;

            foreach ($active_fleets as $attacker_fleet) {

                $attacker_ships_snapshot = array_values(array_filter($attacker_fleet->Ships, function($s) {
                    return $s->Hitpoints > 0;
                }));

                foreach ($attacker_ships_snapshot as $attacker_ship) {

                    if ($attacker_ship->Hitpoints <= 0) {
                        $attacker_fleet->removeShip($attacker_ship);
                        continue;
                    }

                    $possible_targets = array_values(array_filter($active_fleets, function($f) use ($attacker_fleet) {
                        return $f !== $attacker_fleet && $f->getShips() > 0;
                    }));

                    if (empty($possible_targets)) {
                        continue;
                    }
                    $target_fleet = $possible_targets[array_rand($possible_targets)];
                    try {
                        $target_ship = $target_fleet->getRandomAliveShip();
                    } catch (\Exception $e) {
                        continue;
                    }
                    $damage = 0;
                    try {
                        $damage = $attacker_ship->Attack($target_ship);
                    } catch (\Throwable $ex) {
                        $this->Log[] = "Attack error: " . $ex->getMessage();
                        continue;
                    }
                    if ($target_ship->Hitpoints <= 0) {
                        $target_fleet->removeShip($target_ship);
                        $this->Log[] = "Schip {$target_ship->Name} van vloot '{$target_fleet->getFleetName()}' is vernietigd.";
                        echo "\nSchip {$target_ship->Name} van vloot '{$target_fleet->getFleetName()}' is vernietigd.";
                    }

                    if ($attacker_ship->Hitpoints <= 0) {
                        $attacker_fleet->removeShip($attacker_ship);
                        $this->Log[] = "Schip {$attacker_ship->Name} van vloot '{$attacker_fleet->getFleetName()}' is vernietigd.";
                        echo "\nSchip {$attacker_ship->Name} van vloot '{$attacker_fleet->getFleetName()}' is vernietigd.";
                        continue;
                    }
                    if ($damage > 0) $damageThisRound += $damage;
                }
            }
            if ($damageThisRound === 0) {
                $roundsWithoutDamage++;
                if ($roundsWithoutDamage >= $maxRoundsWithoutDamage) {
                    echo "\nBattle aborted: stalemate (no damage for {$maxRoundsWithoutDamage} rounds).";
                    $this->Log[] = "Battle aborted: stalemate (no damage for {$maxRoundsWithoutDamage} rounds).";
                    break;
                }
            } else {
                $roundsWithoutDamage = 0;
            }

        }

        echo $this->getBattleResultReport();
    }
    public function getBattleResultReport(): string
    {
        $survivor_fleets = array_filter($this->Fleets, function($fleet) {
            return $fleet->getShips() > 0;
        });

        $survivor_fleets = array_values($survivor_fleets);
        $survivor_count = count($survivor_fleets);

        if ($survivor_count === 1) {
            $winner = $survivor_fleets[0];
            $msg = "\nVICTORY! Vloot '{$winner->getFleetName()}' heeft de strijd gewonnen met {$winner->getShips()} schepen over.";
            echo $msg;
            return $msg;
        } elseif ($survivor_count === 0) {
            $msg = "\nDRAW. Alle vloten zijn vernietigd. Er is geen winnaar.";
            echo $msg;
            return $msg;
        }

        $msg = "\nUNKNOWN: De strijd is onverwachts geëindigd.";
        echo $msg;
        return $msg;
    }

    public function getLog(): array
    {
        return $this->Log;
    }
}
