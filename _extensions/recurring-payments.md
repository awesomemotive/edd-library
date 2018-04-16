---
layout: page
title: Recurring Payments
permalink: /extensions/recurring-payments/
collection: extensions
category: extensions
---

<ul>
{% for item in site.extensions %}
    {% if item.category == 'recurring-payments' %}
      <li><a href="{{ item.url }}">{{ item.title }}</a>
        - {{ item.description }}
      </li>
  {% endif %}
{% endfor %}
</ul>