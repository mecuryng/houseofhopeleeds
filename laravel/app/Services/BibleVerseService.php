<?php

namespace App\Services;

class BibleVerseService
{
    protected array $books = [
        'Genesis', 'Exodus', 'Leviticus', 'Numbers', 'Deuteronomy',
        'Joshua', 'Judges', 'Ruth', '1 Samuel', '2 Samuel',
        '1 Kings', '2 Kings', '1 Chronicles', '2 Chronicles', 'Ezra',
        'Nehemiah', 'Esther', 'Job', 'Psalms', 'Psalm',
        'Proverbs', 'Ecclesiastes', 'Song of Solomon', 'Isaiah', 'Jeremiah',
        'Lamentations', 'Ezekiel', 'Daniel', 'Hosea', 'Joel',
        'Amos', 'Obadiah', 'Jonah', 'Micah', 'Nahum',
        'Habakkuk', 'Zephaniah', 'Haggai', 'Zechariah', 'Malachi',
        'Matthew', 'Mark', 'Luke', 'John', 'Acts',
        'Romans', '1 Corinthians', '2 Corinthians', 'Galatians', 'Ephesians',
        'Philippians', 'Colossians', '1 Thessalonians', '2 Thessalonians', '1 Timothy',
        '2 Timothy', 'Titus', 'Philemon', 'Hebrews', 'James',
        '1 Peter', '2 Peter', '1 John', '2 John', '3 John',
        'Jude', 'Revelation',
        'Gen', 'Exod', 'Lev', 'Num', 'Deut',
        'Josh', 'Judg', 'Ruth', '1 Sam', '2 Sam',
        '1 Kgs', '2 Kgs', '1 Chr', '2 Chr', 'Ezra',
        'Neh', 'Esth', 'Job', 'Ps', 'Prov',
        'Eccl', 'Song', 'Isa', 'Jer', 'Lam',
        'Ezek', 'Dan', 'Hos', 'Joel', 'Amos',
        'Obad', 'Jon', 'Mic', 'Nah', 'Hab',
        'Zeph', 'Hag', 'Zech', 'Mal',
        'Matt', 'Mk', 'Lk', 'Jn', 'Rom',
        '1 Cor', '2 Cor', 'Gal', 'Eph', 'Phil',
        'Col', '1 Thess', '2 Thess', '1 Tim', '2 Tim',
        'Tit', 'Phlm', 'Heb', 'Jas', '1 Pet',
        '2 Pet', '1 Jn', '2 Jn', '3 Jn', 'Jude',
        'Rev',
    ];

    protected string $versePattern = '/\b((?:1\s*|2\s*|3\s*)?(?:[A-Z][a-z]+|(?:I|II|III)\s+[A-Z][a-z]+))\s+(\d{1,3})\s*:\s*(\d{1,3})(?:\s*[-–]\s*(\d{1,3}))?\b/u';

    public function autoLink(string $text, string $baseUrl = 'https://www.biblegateway.com/passage/?search='): string
    {
        return preg_replace_callback($this->versePattern, function ($matches) use ($baseUrl) {
            $book = trim($matches[1]);
            $chapter = $matches[2];
            $verseStart = $matches[3];
            $verseEnd = $matches[4] ?? null;

            $normalizedName = $this->normalizeBookName($book);
            
            if (!$normalizedName) {
                return $matches[0];
            }

            $reference = $normalizedName . ' ' . $chapter . ':' . $verseStart;
            if ($verseEnd) {
                $reference .= '-' . $verseEnd;
            }

            $encodedReference = urlencode($reference);
            $url = $baseUrl . $encodedReference . '&version=NIV';

            return sprintf(
                '<a href="%s" target="_blank" rel="noopener noreferrer" class="bible-verse-link" title="Read %s on Bible Gateway">%s</a>',
                $url,
                $reference,
                $matches[0]
            );
        }, $text);
    }

    public function extractReferences(string $text): array
    {
        preg_match_all($this->versePattern, $text, $matches, PREG_SET_ORDER);

        $references = [];
        foreach ($matches as $match) {
            $book = trim($match[1]);
            $normalizedName = $this->normalizeBookName($book);
            
            if ($normalizedName) {
                $reference = $normalizedName . ' ' . $match[2] . ':' . $match[3];
                if (isset($match[4]) && $match[4]) {
                    $reference .= '-' . $match[4];
                }
                $references[] = [
                    'original' => $match[0],
                    'normalized' => $reference,
                    'book' => $normalizedName,
                    'chapter' => (int) $match[2],
                    'verse_start' => (int) $match[3],
                    'verse_end' => isset($match[4]) ? (int) $match[4] : null,
                ];
            }
        }

        return $references;
    }

    protected function normalizeBookName(string $name): ?string
    {
        $name = trim($name);
        
        $abbreviations = [
            'Gen' => 'Genesis', 'Exod' => 'Exodus', 'Lev' => 'Leviticus',
            'Num' => 'Numbers', 'Deut' => 'Deuteronomy', 'Josh' => 'Joshua',
            'Judg' => 'Judges', '1 Sam' => '1 Samuel', '2 Sam' => '2 Samuel',
            '1 Kgs' => '1 Kings', '2 Kgs' => '2 Kings', '1 Chr' => '1 Chronicles',
            '2 Chr' => '2 Chronicles', 'Neh' => 'Nehemiah', 'Esth' => 'Esther',
            'Ps' => 'Psalms', 'Psalm' => 'Psalms', 'Prov' => 'Proverbs',
            'Eccl' => 'Ecclesiastes', 'Song' => 'Song of Solomon', 'Isa' => 'Isaiah',
            'Jer' => 'Jeremiah', 'Lam' => 'Lamentations', 'Ezek' => 'Ezekiel',
            'Dan' => 'Daniel', 'Hos' => 'Hosea', 'Obad' => 'Obadiah',
            'Jon' => 'Jonah', 'Mic' => 'Micah', 'Nah' => 'Nahum',
            'Hab' => 'Habakkuk', 'Zeph' => 'Zephaniah', 'Hag' => 'Haggai',
            'Zech' => 'Zechariah', 'Mal' => 'Malachi', 'Matt' => 'Matthew',
            'Mk' => 'Mark', 'Lk' => 'Luke', 'Jn' => 'John',
            'Rom' => 'Romans', '1 Cor' => '1 Corinthians', '2 Cor' => '2 Corinthians',
            'Gal' => 'Galatians', 'Eph' => 'Ephesians', 'Phil' => 'Philippians',
            'Col' => 'Colossians', '1 Thess' => '1 Thessalonians', '2 Thess' => '2 Thessalonians',
            '1 Tim' => '1 Timothy', '2 Tim' => '2 Timothy', 'Tit' => 'Titus',
            'Phlm' => 'Philemon', 'Heb' => 'Hebrews', 'Jas' => 'James',
            '1 Pet' => '1 Peter', '2 Pet' => '2 Peter', '1 Jn' => '1 John',
            '2 Jn' => '2 John', '3 Jn' => '3 John', 'Rev' => 'Revelation',
        ];

        if (isset($abbreviations[$name])) {
            return $abbreviations[$name];
        }

        foreach ($this->books as $book) {
            if (strtolower($book) === strtolower($name)) {
                return $book;
            }
        }

        return null;
    }

    public function isValidReference(string $book, int $chapter, int $verse): bool
    {
        return $this->normalizeBookName($book) !== null && $chapter > 0 && $verse > 0;
    }
}
