# MarkdownTape

## Installation

composer require shadowfiend/markdown-tape

### How to use

```PHP

use Shadowfiend\MarkdownTape

$tape = new MarkdownTape;

$tape->add(your_file);
$tape->add(your_second_file);

$tape->tape();
```