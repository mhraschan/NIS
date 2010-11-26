<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	version="1.0">

	<xsl:output method="html" />

	<xsl:template match="/">
		<xsl:apply-templates />
	</xsl:template>

	<xsl:template match="person_accountings">
		<html>
			<head>
				<title>XSL-Transformation</title>
			</head>
			<body>
				<h1>
					Accountings for
					<xsl:value-of select="person/name" />
				</h1>
				<table border="1">
					<tr>
						<th>Offer</th>
						<th>Date</th>
					</tr>
					<xsl:apply-templates />
				</table>
			</body>
		</html>
	</xsl:template>
	
	<xsl:template match="name">
	</xsl:template>
	
	<xsl:template match="accountings">
		<xsl:apply-templates />
	</xsl:template>

	<xsl:template match="accounting">
		<tr>
			<td>
				<xsl:value-of select="offer" />
			</td>
			<td>
				<xsl:value-of select="date" />
			</td>
		</tr>
	</xsl:template>

</xsl:stylesheet>
