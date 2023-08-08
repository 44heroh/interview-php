<?php
namespace App\Service;

use App\Config\DataConfig;
use App\Entity\Data;
use App\Repository\DataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class DataService
{
    const Length = 19;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var DataConfig
     */
    private DataConfig $dataConfig;
    /**
     * @var DataRepository
     */
    private DataRepository $dataRepository;

    public function __construct(
        DataConfig $dataConfig,
        EntityManagerInterface $entityManager,
        DataRepository $dataRepository
    )
    {
        $this->dataConfig = $dataConfig;
        $this->entityManager = $entityManager;
        $this->dataRepository = $dataRepository;
    }

    /**
     * @throws \Exception
     */
    public function import(): void
    {
        $filePath = $this->dataConfig->getPath();
        $row = 1;

        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($data[1] != "min" && $data[2] != "max") {
                    $dataElement = new Data();
                    $dataElement->setMin($data[1]);
                    $dataElement->setMax($data[2]);
                    $this->entityManager->persist($dataElement);
                    $row++;
                }
            }
            fclose($handle);
            $this->entityManager->flush();
        } else {
            throw new \Exception("do not find file '$filePath' or not readable");
        }
    }

    /**
     * @param int $num
     * @return int
     * @throws \Exception
     */
    public function getRangeId(int $num): int
    {
        $paddedNumber = str_pad($num, DataService::Length, '0', STR_PAD_RIGHT);
        $ans = $this->dataRepository->findIdByNumber($paddedNumber);
        if($ans == []) {
            throw new \Exception("do not found intervals");
        }

        return $ans[0]->getId();
    }
}