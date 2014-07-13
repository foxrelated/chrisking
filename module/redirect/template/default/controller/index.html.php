<meta itemprop="creator" content="{$aDvs.dealer_user_full_name}" />
<meta itemprop="productionCompany" content="WheelsTV" />
<meta itemprop="contributor" content="{$aDvs.dealer_name}" />
<meta itemprop="url" content="{$sRedirectUrl}" id="schema_video_url"/>
<meta itemprop="thumbnailUrl" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_thumbnail_url"/>
<meta itemprop="image" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_image"/>
<meta itemprop="uploadDate" content="{$aFirstVideoMeta.upload_date}"  id="schema_video_upload_date"/>
<meta itemprop="duration" content="{$aFirstVideoMeta.duration}"  id="schema_video_duration"/>
<meta itemprop="name" content="{$aFirstVideoMeta.name}"  id="schema_video_name"/>
<meta itemprop="description" content="{$aFirstVideoMeta.description}"  id="schema_video_description"/>


<article>
    <section id="video_information">
        <h3 id="video_name">{$aFirstVideo.name}</h3>
        <p class="model_description" id="car_description">{$aFirstVideo.longDescription}</p>
    </section>
</article>