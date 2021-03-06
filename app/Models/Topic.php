<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Topic extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'topics_index';
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'category' => $this->category->name,
            'body' => strigTags($this->body)
        ];
    }

    protected $casts = [
        'forme' => 'boolean',
        'top' => 'boolean'
    ];

    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug', 'top', 'forme'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @param $order
     */
    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('top', 'desc')->orderBy('updated_at', 'desc');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('top', 'desc')->orderBy('created_at', 'desc');
    }

    public function scopeShowOwn($query, $user)
    {
        if ($user) {
            if($user->can('manage_contents'))
            {
                return $query;
            } else {
                return $query->where('forme', 0)->orWhere([ ['user_id', $user->id], ['forme', 1]]);
            }
        } else {
            return $query->where('forme', 0);
        }
    }

    /**
     * @param array $params
     * @return string
     */
    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function updateReplyCount()
    {
        $this->reply_count = $this->replies->count();
        $this->save();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function topReplies()
    {
        return $this->replies()->limit(5);
    }
}
