# Generated by Django 3.1.3 on 2021-02-13 20:42

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ("app", "0023_auto_20210207_2137"),
    ]

    operations = [
        migrations.AlterField(
            model_name="address",
            name="phone_number",
            field=models.CharField(max_length=13, null=True),
        ),
    ]