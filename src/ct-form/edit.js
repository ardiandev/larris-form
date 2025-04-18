/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

import {useState} from "@wordpress/element";
import {TextControl ,PanelBody, PanelRow, FontSizePicker} from "@wordpress/components"


export default function Edit(props) {
	const {attributes, setAttributes} = props
	const {
		textareaHeight,
		inputGap, 
		inputFontSize, 
		inputPadding, 
		inputMarginTop,
		nameLabel,
		subjectLabel,
		emailLabel,
		messageLabel
	} = attributes;

	const [name, setName] = useState("My First and Last Name");
	const [message, setMessage] = useState("")

	const handleInputGap = (value) => {
		setAttributes({inputGap: value})
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title="Form Settings" initialOpen={true}>
					<TextControl
						label="Email Recipent"
						value=""
					/>
					<p>To send emails to providers like Gmail, Yahoo, or Hotmail, please install an SMTP plugin. Without it, this form can only send to email addresses on your own domain, such as yourname@yourdomain.com.</p>
					<p>Learn how to set up the contact form and configure SMTP by reading the documentation: <a href='#'>View Guide</a></p>					
					<TextControl
						label="Email Subject"
						value=""
					/>
					<p>This subject will appear in the email you receive when someone submits the form.</p>
				</PanelBody>
				<PanelBody title="Label Text Settings" initialOpen={true}>
					<TextControl
						value={nameLabel}
						onChange={value => setAttributes({nameLabel: value})}
					/>	
					<TextControl
						value={subjectLabel}
						onChange={value => setAttributes({subjectLabel: value})}
					/>	
					<TextControl
					value={emailLabel}
					onChange={value => setAttributes({emailLabel: value})}
					/>		
					<TextControl
						value={messageLabel}
						onChange={value => setAttributes({messageLabel: value})}
					/>						
				</PanelBody>

			</InspectorControls>
			<InspectorControls group="styles">
				<PanelBody title="Input Settings" initialOpen={true}>
						<TextControl
							label="Label Font Size"
							value={inputFontSize}
							onChange={(value) => setAttributes({inputFontSize: value})}
							help="Set the input height (e.g., 40px, 2em, etc.)"
							className="input-textcontrol"
						/>	
						<TextControl
							label="Input Font Size"
							value={inputFontSize}
							onChange={(value) => setAttributes({inputFontSize: value})}
							help="Set the input height (e.g., 40px, 2em, etc.)"
							className="input-textcontrol"
						/>	
						<TextControl
							label="Padding"
							value={inputPadding}
							onChange={(value) => { setAttributes({inputPadding: value})}}
							help="You can set like 10px or 10px 30px"
							className="input-textcontrol"
						/>
						<TextControl
							label="Margin Top"
							value={inputMarginTop}
							onChange={value => setAttributes({inputMarginTop: value})}
							help="Set the input height (e.g., 40px, 2em, etc.)"
							className="input-textcontrol"
						/>
						<TextControl
							label="Gap"
							value={inputGap}
							onChange={handleInputGap}
							help="Set the input height (e.g., 40px, 2em, etc.)"
							className="input-textcontrol"
						/>
				</PanelBody>
			</InspectorControls>

			<div { ...useBlockProps() }>
				<form action="">
					<ul>
						<li style={{gap: inputGap}} >
							<label htmlFor="yourname">{nameLabel}</label>
							<input style={{height: "", fontSize: inputFontSize, padding: inputPadding}} value={name} onChange={(event) => {setName(event.target.value)}} type="text" id='yourname' name="yourname" />
						</li>
						<li style={{gap: inputGap, marginTop: inputMarginTop }} >
							<label htmlFor="yourname">{subjectLabel}</label>
							<input style={{height: "", fontSize: inputFontSize, padding: inputPadding}} value={name} onChange={(event) => {setName(event.target.value)}} type="text" id='yourname' name="yourname" />
						</li>
						<li style={{gap: inputGap, marginTop: inputMarginTop }} >
							<label htmlFor="youremail">{emailLabel}</label>
							<input style={{height: "", fontSize: inputFontSize, padding: inputPadding}} value={name} onChange={(event) => {setName(event.target.value)}} type="text" id='youremail' name="youremail" />
						</li>
						<li style={{gap: inputGap, marginTop: inputMarginTop,  }} >
							<label htmlFor="yourmessage">{messageLabel}</label>
							<textarea 
							style={{fontSize: inputFontSize, padding: inputPadding, minHeight: textareaHeight}}
							value={message}
							onChange={(event) => {setMessage(event.target.value)}}							
							></textarea>
						</li>
					</ul>
				</form>
			</div>
		</>
	);
}
