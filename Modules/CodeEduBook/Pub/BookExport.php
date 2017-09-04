<?php

namespace CodeEduBook\Pub;

use CodeEduBook\Criteria\FindByBook;
use CodeEduBook\Criteria\OrderByOrder;
use CodeEduBook\Models\Book;
use CodeEduBook\Repositories\ChapterRepository;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

class BookExport
{
    /**
     * @var ChapterRepository
     */
    private $chapterRepository;
    /**
     * @var Parser
     */
    private $ymParser;
    /**
     * @var Dumper
     */
    private $ymDumper;


    /**
     * BookExport constructor.
     * @param ChapterRepository $chapterRepository
     * @param Parser $ymParser
     * @param Dumper $ymDumper
     */
    public function __construct(ChapterRepository $chapterRepository, Parser $ymParser, Dumper $ymDumper)
    {
        $this->chapterRepository = $chapterRepository;
        $this->ymParser = $ymParser;
        $this->ymDumper = $ymDumper;
    }

    public function export(Book $book)
    {
        $chapters = $this->chapterRepository->pushCriteria(new FindByBook($book->id))->pushCriteria(new OrderByOrder())->all();
        $this->exportContents($book, $chapters);

        file_put_contents("{$book->contents_storage}/dedication.md", $book->dedication);

        $configContents = file_get_contents($book->template_config_file);
        $config = $this->ymParser->parse($configContents);
        $config['book']['title'] = $book->tile;
        $config['book']['author'] = $book->author->name;

        $contents = [];
        foreach ($chapters as $chapter) {
            $contents[] = [
                'element' => 'chapter',
                'number'  => $chapter->order,
                'content' => "{$chapter->order}.md"
            ];
        }

        $book['book']['contents'] = array_merge($config['book']['contents'], $contents);

        $yml = $this->ymDumper->dump($config, 4);

        file_put_contents($book->config_file, $yml);
    }

    /**
     * @param Book $book
     * @param $chapters
     */
    protected function exportContents(Book $book, $chapters)
    {
        if (!is_dir($book->contents_storage)) {
            mkdir($book->contents_storage, 0775, true);
        }

        foreach ($chapters as $chapter) {
            file_put_contents("{$book->contents_storage}/{$chapter->order}.md", $chapter->content);
        }
    }
}