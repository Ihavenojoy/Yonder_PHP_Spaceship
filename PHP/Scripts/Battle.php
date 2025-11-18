<?php

namespace Scripts;

use Entities\Fleet;

class Battle
{
    public array $Fleets;

    public function __construct()
    {
        $this->Fleets = [];
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
                if ($survivor_count > 1) {
                    return false;
                }
            }
        }
        return true;
    }

    public function BattleLoop()
    {
        while (!$this->BattleDone())
        {
            $active_fleets = array_filter($this->Fleets, function($fleet) {
                return $fleet->getShips() > 0;
            });

            if (count($active_fleets) < 2) {
                break;
            }

            foreach ($active_fleets as $attacker_fleet)
            {
                if ($attacker_fleet->getShips() <= 0) {
                    continue;
                }

                $targets = array_filter($active_fleets, function($fleet) use ($attacker_fleet) {
                    return $fleet !== $attacker_fleet;
                });

                if (empty($targets)) {
                    break 2;
                }

                $target_fleet_index = array_rand($targets);
                $target_fleet = $targets[$target_fleet_index];

                try {
                    $attacking_spaceship = $attacker_fleet->getAvailableShip();
                    $attacking_spaceship->AttackFleet($target_fleet);
                } catch (\Exception $e) {
                    continue;
                }

                $target_fleet->removeDeadShips();
                $attacker_fleet->removeDeadShips();

                if ($this->BattleDone()) {
                    break 2;
                }
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
            return "\nVICTORY! Vloot '{$winner->getFleetName()}' heeft de strijd gewonnen met {$winner->getShips()} schepen over.";
        } elseif ($survivor_count === 0) {
            return "\nDRAW. Alle vloten zijn vernietigd. Er is geen winnaar.";
        }

        return "\nUNKNOWN: De strijd is onverwachts geëindigd.";
    }
}