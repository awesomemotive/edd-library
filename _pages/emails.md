---
layout: page
title: Emails
permalink: /emails/
category: emails
---

<ul>
{% for item in site.emails %}
  <li><a href="{{ item.url }}">{{ item.title }}</a>
    - {{ item.description }}
  </li>
{% endfor %}
</ul>