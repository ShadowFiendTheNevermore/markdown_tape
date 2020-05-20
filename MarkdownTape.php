<?php

namespace ShadowFiend;

class MarkdownTape
{
    protected $files = [];

    /**
     * 
     */
    public function add($file)
    {
        $file = realpath($file);
        if (!is_file($file)) {
            throw new \Exception("Is not file");
        }

        $this->files[] = $file;

        return $this;
    }


    private function getFilename($file)
    {
        $explode = explode(DIRECTORY_SEPARATOR, $file);

        return end($explode);
    }

    private function getFileContext($file)
    {
        $content = "";
        $context = fopen($file, 'r');

        while(!feof($context)) {
            $line = fgets($context);
            $line = trim(ltrim(rtrim($line)));

            if (!strlen($line)) {
                continue;
            }

            $content .= $line . "\n\n";
        }

        return trim($content);
    }

    private function getFilenameTitle(string $file, int $level)
    {
        $title = explode('.', $this->getFilename($file))[0];
        $levels = ["\n ======== \n", "\n -------- \n"];

        return $title . $levels[$level - 1];
    }

    public function tape(string $filename = "tapedWithLove.md", $title_level = 1)
    {
        $content = "";
        foreach ($this->files as $file) {
            $text = $this->getFileContext($file);
            $title = $this->getFilenameTitle($file, $title_level);
            $content .= "\n" . $title . "\n" . $text . "\n";
        }

        $result = file_put_contents($filename, trim($content), LOCK_EX);
        return $result;
    }
}



