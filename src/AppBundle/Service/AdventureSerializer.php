<?php

namespace AppBundle\Service;


use AppBundle\Entity\Adventure;
use AppBundle\Entity\Author;
use AppBundle\Entity\Environment;
use AppBundle\Entity\Item;
use AppBundle\Entity\Monster;

class AdventureSerializer
{
    public function toElasticDocument(Adventure $adventure): array
    {
        $ser = [
            'authors' => $adventure->getAuthors()->map(function (Author $author) { return $author->getName(); })->getValues(),
            'edition' => $this->getNameOrNull($adventure->getEdition()),
            'environments' => $adventure->getEnvironments()->map(function (Environment $environment) { return $environment->getName(); })->getValues(),
            'items' => $adventure->getItems()->map(function (Item $item) { return $item->getName(); })->getValues(),
            'publisher' => $this->getNameOrNull($adventure->getPublisher()),
            'setting' => $this->getNameOrNull($adventure->getSetting()),
            'commonMonsters' => $adventure->getCommonMonsters()
                ->map(function (Monster $monster) { return $monster->getName(); })->getValues(),
            'bossMonsters' => $adventure->getBossMonsters()
                ->map(function (Monster $monster) { return $monster->getName(); })->getValues(),

            'title' => $adventure->getTitle(),
            'description' => $adventure->getDescription(),
            'slug' => $adventure->getSlug(),
            'minStartingLevel' => $adventure->getMinStartingLevel(),
            'maxStartingLevel' => $adventure->getMaxStartingLevel(),
            'startingLevelRange' => $adventure->getStartingLevelRange(),
            'numPages' => $adventure->getNumPages(),
            'foundIn' => $adventure->getFoundIn(),
            'partOf' => $adventure->getPartOf(),
            'link' => $adventure->getLink(),
            'thumbnailUrl' => $adventure->getThumbnailUrl(),
            'soloable' => $adventure->isSoloable(),
            'pregeneratedCharacters' => $adventure->hasPregeneratedCharacters(),
            'tacticalMaps' => $adventure->hasTacticalMaps(),
            'handouts' => $adventure->hasHandouts(),
        ];

        return $ser;
    }

    /**
     * @param $entity
     * @return null|string
     */
    private function getNameOrNull($entity)
    {
        return $entity === null ? null : $entity->getName();
    }
}
