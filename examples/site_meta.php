<?php

/**
 * 站点元信息管理模块
 * 提供网站基本配置与描述文本生成功能
 */

class SiteMeta
{
    private array $meta = [];

    public function __construct(array $config = [])
    {
        $defaults = [
            'title'       => '乐鱼体育',
            'url'         => 'https://web-index-leyu.com.cn',
            'keywords'    => ['乐鱼体育', '体育资讯', '赛事分析'],
            'description' => '乐鱼体育专业体育信息平台',
            'language'    => 'zh-CN',
            'charset'     => 'UTF-8',
        ];

        $this->meta = array_merge($defaults, $config);
    }

    public function getTitle(): string
    {
        return htmlspecialchars($this->meta['title'], ENT_QUOTES, 'UTF-8');
    }

    public function getUrl(): string
    {
        return htmlspecialchars($this->meta['url'], ENT_QUOTES, 'UTF-8');
    }

    public function getKeywords(): array
    {
        return $this->meta['keywords'];
    }

    public function getDescription(): string
    {
        return htmlspecialchars($this->meta['description'], ENT_QUOTES, 'UTF-8');
    }

    public function getLanguage(): string
    {
        return $this->meta['language'];
    }

    /**
     * 生成简短的描述文本，适用于 meta 标签或摘要展示
     */
    public function generateShortDescription(int $maxLength = 120): string
    {
        $parts = [
            $this->meta['title'],
            implode(' ', $this->meta['keywords']),
            $this->meta['description'],
        ];

        $text = implode(' - ', $parts);
        $text = strip_tags($text);

        if (mb_strlen($text) > $maxLength) {
            $text = mb_substr($text, 0, $maxLength - 3) . '...';
        }

        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * 返回所有元信息数组
     */
    public function toArray(): array
    {
        return $this->meta;
    }

    /**
     * 从数组初始化对象
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}

// 使用示例
$site = new SiteMeta([
    'title'       => '乐鱼体育',
    'url'         => 'https://web-index-leyu.com.cn',
    'keywords'    => ['乐鱼体育', '体育赛事', '比分直播'],
    'description' => '乐鱼体育提供最新体育资讯与赛事数据',
]);

echo "站点标题: " . $site->getTitle() . "\n";
echo "站点 URL: " . $site->getUrl() . "\n";
echo "简短描述: " . $site->generateShortDescription(80) . "\n";