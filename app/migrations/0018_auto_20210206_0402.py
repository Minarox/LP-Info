# Generated by Django 3.1.4 on 2021-02-06 03:02

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ("app", "0017_auto_20210206_0401"),
    ]

    operations = [
        migrations.AlterField(
            model_name="address",
            name="user",
            field=models.ForeignKey(
                on_delete=django.db.models.deletion.CASCADE, to="app.user"
            ),
        ),
    ]
