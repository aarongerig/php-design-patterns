<?php

namespace InheritanceAndTraits;

require __DIR__ . '/../TablePrinter.php';

trait Categorizable
{
    public function getCategoryTable(): string
    {
        return "I am the table {$this->categoryTableName}";
    }

    public function getCategories(): array
    {
        return ['Awesome', 'Even More Awesome'];
    }
}

trait Taggable
{
    public function getTagTable(): string
    {
        return "I am the table {$this->tagTableName}";
    }

    public function getTags(): array
    {
        return ['#awesome', '#evenmoreawesome'];
    }
}

class FakeORM
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    // Stubbed out instead of making a DB call
    public static function find($id)
    {
        return new static($id);
    }
}

class Post extends FakeORM
{
    use Categorizable, Taggable;

    protected $categoryTableName = 'post_categories';
    protected $tagTableName = 'post_tags';
}

$post = Post::find(1);

$tp = new \TablePrinter(['Method', 'Names', 'Results']);
$tp->addRow('Post::getCategoryTable()', $post->getCategoryTable(), implode(', ', $post->getCategories()));
$tp->addRow('Post::getTagTable()', $post->getTagTable(), implode(', ', $post->getTags()));
$tp->output();
